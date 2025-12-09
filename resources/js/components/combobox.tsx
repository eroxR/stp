import { router, usePage } from '@inertiajs/react'; // Importar router de Inertia
import { Check, ChevronsUpDown } from 'lucide-react';
import * as React from 'react';

import { Button } from '@/components/ui/button';
import { Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList } from '@/components/ui/command';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { useDebounce } from '@/hooks/useDebounce'; // ¡Importante! (ver más abajo)
import { cn } from '@/lib/utils'; // Asumiendo que tienes un archivo utils

// interface EconomicActivity {
//     code: string;
//     name: string;
// }

// interface EconomicActivityComboboxProps {
//     economicActivities: EconomicActivity[];
//     value: string; // El código de la actividad seleccionada
//     onChange: (value: string) => void;
//     filters: {
//         search: string | null;
//     };
// }

// 1. Interfaz Genérica para cualquier item (Actividad, Identificación, País, etc.)
export interface ComboboxItem {
    value: string;
    label: string;
}

interface ComboboxProps {
    items: ComboboxItem[]; // Antes "economicActivities"
    value: string; // El valor seleccionado
    onChange: (value: string) => void;
    placeholder?: string; // Texto cuando no hay nada seleccionado
    searchPlaceholder?: string; // Texto del input de búsqueda

    // Configuración para la búsqueda en servidor (Inertia)
    searchParam?: string; // Nombre del parámetro en la URL (ej: 'search_activity' o 'search_id')
    currentSearch?: string | null; // El valor actual de la búsqueda que viene del backend
    dataToReload?: string[]; // Qué props recargar en Inertia (ej: ['economicActivities'])
}

export function Combobox({
    items,
    value,
    onChange,
    placeholder = 'Selecciona una opción...',
    searchPlaceholder = 'Buscar...',
    searchParam = 'search',
    currentSearch = '',
    dataToReload = [],
}: ComboboxProps) {
    const [open, setOpen] = React.useState(false);

    // Estado local para el input de búsqueda
    const [searchQuery, setSearchQuery] = React.useState(currentSearch || '');

    // Hook de "debounce" para no saturar la base de datos
    // Esto espera 300ms después de que el usuario deja de escribir para hacer la llamada
    const debouncedSearch = useDebounce(searchQuery, 300);

    // 1. Obtén las props de la página actual con el hook usePage
    const { url } = usePage();
    // 2. Extrae la ruta base sin los query parameters para evitar duplicados
    const currentPath = url.split('?')[0];

    // Encontrar la actividad seleccionada para mostrar su nombre en el botón
    const selectedItem = items.find((item) => item.value === value) || null;

    // Efecto que llama a Inertia cuando la búsqueda "debounced" cambia
    React.useEffect(() => {
        if (!searchParam) return;
        // No hacer la primera llamada si el filtro inicial ya estaba cargado
        if (debouncedSearch === (currentSearch || '')) {
            return;
        }

        router.get(
            currentPath, // Ruta actual
            { [searchParam]: debouncedSearch }, // Enviar undefined si está vacío para limpiar la UR
            {
                preserveState: true,
                preserveScroll: true,
                only: [...dataToReload, 'filters'], // ¡Solo actualizar estas props!
            },
        );
    }, [debouncedSearch, currentSearch, searchParam, currentPath, dataToReload]);

    const handleSelect = (currentValue: string) => {
        const newValue = currentValue === value ? '' : currentValue;
        onChange(newValue); // Llama a la función del formulario de Inertia
        setOpen(false);

        // setSearchQuery('');
        // setOpen(false);
    };

    return (
        <Popover open={open} onOpenChange={setOpen}>
            <PopoverTrigger asChild>
                <Button variant="outline" role="combobox" aria-expanded={open} className="w-full justify-between border-2">
                    {value && selectedItem ? selectedItem.label : placeholder}
                    <ChevronsUpDown className="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
            </PopoverTrigger>
            <PopoverContent className="max-h-[--radix-popover-available-height] w-[--radix-popover-trigger-width] p-0">
                <Command>
                    <CommandInput placeholder={searchPlaceholder} value={searchQuery} onValueChange={setSearchQuery} />
                    <CommandEmpty>No se encontraron resultados.</CommandEmpty>
                    <CommandList>
                        <CommandGroup>
                            {items.map((item) => (
                                <CommandItem key={item.value} value={item.value} onSelect={handleSelect}>
                                    <Check className={cn('mr-2 h-4 w-4', value === item.value ? 'opacity-100' : 'opacity-0')} />
                                    {item.label}
                                </CommandItem>
                            ))}
                        </CommandGroup>
                    </CommandList>
                </Command>
            </PopoverContent>
        </Popover>
    );
}
