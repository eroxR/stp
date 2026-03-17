import MasterViewLayout from '@/components/master-view-layout';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { MySwal } from '@/lib/swal';
import { Head, useForm } from '@inertiajs/react';
import { Edit, Eye, EyeOff, Globe, MapPin, PlusCircle, Save, Trash2, X } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';
import { CustomTooltip } from '@/components/ui/custom-tooltip';

// Interfaces

interface Country {
    id: number;
    code_country: string;
    country_name: string;
    visibility: string;
    company_view: number[] | string[] | null;
}

interface FormData {
    code_country: string;
    country_name: string;
    visibility: string;
}

interface Props {
    data: Country[] | any;
}

export default function CountryMaster({ data }: Props) {
    const [editingId, setEditingId] = useState<number | null>(null);

    const {
        data: formData,
        setData,
        post,
        put,
        delete: destroy,
        processing,
        errors,
        reset,
    } = useForm<FormData>({
        code_country: '',
        country_name: '',
        visibility: '1',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingId) {
            put(`/settings/masterTables/countries/${editingId}`, {
                onSuccess: () => {
                    handleCancel();
                    toast.success('País actualizado correctamente');
                },
                onError: () => toast.error('Error al actualizar'),
            });
        } else {
            post('/settings/masterTables/countries', {
                onSuccess: () => {
                    reset();
                    toast.success('País creado correctamente');
                },
                onError: () => toast.error('Error al crear'),
            });
        }
    };

    const handleEdit = (item: Country) => {
        setEditingId(item.id);
        setData({
            code_country: item.code_country,
            country_name: item.country_name,
            visibility: item.visibility,
        });
    };

    const handleCancel = () => {
        setEditingId(null);
        reset();
    };

    const handleDelete = (id: number) => {
        MySwal.fire({
            title: '¿Estás seguro?',
            text: 'El país se eliminará permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'dark:bg-gray-900 dark:text-white',
                confirmButton: 'bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none mx-2',
                cancelButton:
                    'bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none mx-2 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600',
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(`/settings/masterTables/countries/${id}`, {
                    preserveScroll: true,
                    onSuccess: () => {
                        MySwal.fire({
                            title: '¡Eliminado!',
                            text: 'El registro ha sido eliminado correctamente.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    },
                    onError: () => {
                        MySwal.fire({
                            title: 'Error',
                            text: 'No se pudo eliminar el registro.',
                            icon: 'error',
                        });
                    },
                });
            }
        });
    };

    // --- RENDERIZADORES ---

    // 1. Diseño para GRID (Pocos datos) - Tipo tarjeta visual
    const renderCard = (item: Country) => (
        <Card
            key={item.id}
            className={`flex flex-col justify-between transition-all hover:shadow-md ${
                editingId === item.id
                    ? 'border border-amber-500 bg-muted/50 shadow-lg ring-amber-500 ring-offset-2 ring-offset-background dark:bg-amber-950/20'
                    : 'border-border'
            }`}
        >
            <CardHeader className="pb-2">
                <div className="w-full">
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Código País:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.code_country}</span>
                    </div>
                </div>
                <div className="w-full">
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Nombre País:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.country_name}</span>
                    </div>
                </div>
            </CardHeader>

            <CardFooter className="mt-auto flex justify-end gap-2 border-t bg-muted/10 pt-2 dark:bg-muted/5">
                <CustomTooltip text="Ocultar">
                    <Button variant="ghost" size="sm" onClick={() => handleEdit(item)}>
                        <EyeOff className="h-4 w-4 text-orange-500" />
                    </Button>
                </CustomTooltip>
                <CustomTooltip text="Mostrar">
                    <Button variant="ghost" size="sm" onClick={() => handleEdit(item)}>
                        <Eye className="h-4 w-4 text-green-500" />
                    </Button>
                </CustomTooltip>
                <CustomTooltip text="Editar">
                    <Button variant="ghost" size="sm" onClick={() => handleEdit(item)}>
                        <Edit className="h-4 w-4 text-blue-500" />
                    </Button>
                </CustomTooltip>
                <CustomTooltip text="Eliminar">
                    <Button variant="ghost" size="sm" onClick={() => handleDelete(item.id)}>
                        <Trash2 className="h-4 w-4 text-red-500" />
                    </Button>
                </CustomTooltip>
            </CardFooter>
        </Card>
    );

    // 2. Diseño para LISTA (Muchos datos) - Fila compacta horizontal
    const renderRow = (item: Country) => (
        <div
            key={item.id}
            className={`group flex items-center justify-between rounded-md border bg-card p-3 transition-colors hover:bg-accent/50 ${
                editingId === item.id ? 'border-amber-500 bg-amber-50 dark:bg-amber-950/20' : 'border-border'
            }`}
        >
            {/* Información Izquierda */}
            <div className="flex items-center gap-4 overflow-hidden">
                <div className="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                    <Globe className="h-4 w-4 text-emerald-600 dark:text-emerald-400" />
                </div>

                <div className="flex flex-wrap items-center gap-2">
                    <span className="text-sm font-medium text-blue-500">Código País:</span>
                    <Badge variant="outline" className="bg-background">
                        {item.code_country}
                    </Badge>
                    <span className="text-sm font-medium text-blue-500">Nombre País:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.country_name}</span>
                </div>
            </div>

            {/* Acciones Derecha */}
            <div className="ml-4 flex shrink-0 items-center gap-3">
                <div className="flex items-center gap-1">
                    <CustomTooltip text="Ocultar">
                        <Button
                            variant="ghost"
                            size="icon"
                            onClick={() => handleEdit(item)}
                            className="h-8 w-8 text-muted-foreground hover:text-orange-600"
                        >
                            <EyeOff className="h-4 w-4 text-orange-500" />
                        </Button>
                    </CustomTooltip>
                    <CustomTooltip text="Mostrar">
                        <Button
                            variant="ghost"
                            size="icon"
                            onClick={() => handleEdit(item)}
                            className="h-8 w-8 text-muted-foreground hover:text-green-600"
                        >
                            <Eye className="h-4 w-4 text-green-500" />
                        </Button>
                    </CustomTooltip>
                    <CustomTooltip text="Editar">
                        <Button
                            variant="ghost"
                            size="icon"
                            onClick={() => handleEdit(item)}
                            className="h-8 w-8 text-muted-foreground hover:text-blue-600"
                        >
                            <Edit className="h-4 w-4 text-blue-500" />
                        </Button>
                    </CustomTooltip>
                    <CustomTooltip text="Eliminar">
                        <Button
                            variant="ghost"
                            size="icon"
                            onClick={() => handleDelete(item.id)}
                            className="h-8 w-8 text-muted-foreground hover:text-red-600"
                        >
                            <Trash2 className="h-4 w-4 text-red-500" />
                        </Button>
                    </CustomTooltip>
                </div>
            </div>
        </div>
    );

    return (
        <div className="flex h-full flex-col gap-6">
            <Head title="Países" />

            {/* SECCIÓN FIJA: FORMULARIO */}
            <div className="flex-none space-y-6">
                <div>
                    <h2 className="text-2xl font-bold tracking-tight">Maestra de Países</h2>
                    <p className="text-sm text-muted-foreground">Administra los países disponibles en el sistema (ej: COL, USA).</p>
                </div>

                <Card className="border-l-4 border-l-blue-600 bg-muted/20 shadow-sm dark:bg-muted/10">
                    <CardContent className="pt-6">
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            {/* Fila 1 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full gap-1.5 md:w-32">
                                    <Label htmlFor="code">Código País</Label>
                                    <div className="relative">
                                        <MapPin className="absolute top-2.5 left-2.5 h-4 w-4 text-muted-foreground" />
                                        <Input
                                            id="code"
                                            className="pl-9"
                                            placeholder="Ej: COL"
                                            value={formData.code_country}
                                            onChange={(e) => setData('code_country', e.target.value.toUpperCase())}
                                            disabled={processing}
                                            maxLength={3}
                                        />
                                    </div>
                                    {errors.code_country && <span className="text-xs text-red-500">{errors.code_country}</span>}
                                </div>

                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="name">Nombre del País</Label>
                                    <Input
                                        id="name"
                                        placeholder="Ej: Colombia"
                                        value={formData.country_name}
                                        onChange={(e) => setData('country_name', e.target.value)}
                                        disabled={processing}
                                        maxLength={60}
                                    />
                                    {errors.country_name && <span className="text-xs text-red-500">{errors.country_name}</span>}
                                </div>

                                <div className="flex w-full items-end justify-end gap-2 pt-1 md:w-auto">
                                    {editingId && (
                                        <Button type="button" variant="outline" onClick={handleCancel}>
                                            <X className="mr-2 h-4 w-4" />
                                        </Button>
                                    )}
                                    <Button type="submit" disabled={processing} className={editingId ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700 dark:text-white'}>
                                        {editingId ? <Save className="mr-2 h-4 w-4" /> : <PlusCircle className="mr-2 h-4 w-4" />}
                                        {editingId ? 'Actualizar' : 'Crear'}
                                    </Button>
                                </div>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>

            {/* SECCIÓN DINÁMICA: GRID O LISTA (Manejado por MasterViewLayout) */}
            <MasterViewLayout data={data} renderCard={renderCard} renderRow={renderRow} />
        </div>
    );
}
