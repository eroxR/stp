import SidebarLayout, { MenuSection } from '@/components/sidebar-layout';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import AppLayout from '@/layouts/app-layout';
import { MySwal } from '@/lib/swal';
import { cn } from '@/lib/utils';
import { Head, useForm } from '@inertiajs/react';
import { format } from 'date-fns';
import { es } from 'date-fns/locale'; // Importante para español
import dayjs from 'dayjs';
import { Briefcase, GraduationCap, HeartPulse, MapPin, Ruler, Save, User as UserIcon, Users } from 'lucide-react';
import { useMemo, useState } from 'react';
import { useTranslation } from 'react-i18next';

interface CatalogItem {
    id: number;
    [key: string]: string | number;
}

export interface Catalogs {
    charges: CatalogItem[];
    cities: CatalogItem[];
    countries: CatalogItem[];
    civilStatuses: CatalogItem[];
    workAreas: CatalogItem[];
    shoeSizes: CatalogItem[];
    Provinces: CatalogItem[];
    arls: CatalogItem[];
    bloodTypes: CatalogItem[];
    bondings: CatalogItem[];
    compensationBoxes: CatalogItem[];
    educationLevels: CatalogItem[];
    healthEntities: CatalogItem[];
    identifications: CatalogItem[];
    layoffs: CatalogItem[];
    pensions: CatalogItem[];
    relationships: CatalogItem[];
    userTypes: CatalogItem[];
}

interface FormSchema {
    id: number;
    firstname: string;
    secondname?: string;
    lastname: string;
    motherslastname?: string;
    email: string;
    identificationcard: string;
    user_status: string; // '1' usually means Active

    // IDs (Foreign Keys) - Usamos string | number porque los selects html usan strings
    identification: string | number;
    city: string | number;
    country: string | number;
    department: string | number;
    charge: string | number;
    work_area: string | number;
    civil_status: string | number;
    usertype: string | number;
    bonding: string | number;
    eps: string | number;
    arl: string | number;
    pension: string | number;
    layoffs: string | number;
    compensationbox: string | number;
    branch: string | number;
    cityBirth: string | number;
    educationLevel: string | number;
    relationship: string | number;

    shoeSize: string | number;
    place_expedition_identificationcard?: string;

    // Fechas y Textos
    address: string;
    phone: string;
    phone_cellular: string;
    user_entry_date: string;
    salary: number;
    aid_transport: number;

    type_sex: string;
    bloodType: string | number;
    functions_performed: string;

    date_eps: string;
    arl_date: string;
    date_pension: string;
    date_layoffs: string;
    date_compensationbox: string;

    // Familia / Contacto Emergencia
    family_names: string;
    family_document_type: number; // O relación si existe
    identificationcard_family: string;
    family_address: string;
    family_phone: string;
    family_phone_cellular: string;

    // Dotación
    weight: number;
    shirt_size: string;
    pant_size: number;

    // Educación
    educational_institution: string;
    last_course: string;
    study_end_date: string;
    obtained_title: string;

    // Experiencia Pasada
    last_company_name: string;
    charges_last_company: string;
    start_date_last_company: string;
    date_end_last_company: string;

    // ... agrega cualquier otro campo que necesites guardar
}

export interface Employee {
    id: number;
    username: string;
    email: string;
    user_status: string;
    firstname: string;
    secondname?: string;
    lastname: string;
    motherslastname?: string;
    identificationcard: string;
    place_expedition_identificationcard?: string;
    address?: string;
    phone?: string;
    phone_cellular?: string;
    birthdate?: string;
    age?: number;
    type_sex?: string;
    user_entry_date?: string;
    date_refund?: string;
    salary?: number;
    aid_transport?: number;
    functions_performed?: string;
    code_company?: string;
    last_company_name?: string;
    charges_last_company?: string;
    start_date_last_company?: string;
    date_end_last_company?: string;
    family_names?: string;
    family_address?: string;
    family_phone?: string;
    family_phone_cellular?: string;
    educational_institution?: string;
    last_course?: string;
    study_end_date?: string;
    obtained_title?: string;
    shirt_size?: string;
    pant_size?: number;
    weight?: number;
    date_eps?: string;
    arl_date?: string;
    date_pension?: string;
    date_layoffs?: string;
    date_compensationbox?: string;

    identification: number | null; // Columna 'identification'
    city: number | null; // Columna 'city'
    department: number | null; // Columna 'department'
    country: number | null; // Columna 'country'
    charge: number | null; // Columna 'charge'
    work_area: number | null; // Columna 'work_area'
    civil_status: number | null; // Columna 'civil_status'
    usertype: number | null; // Columna 'usertype'
    eps: number | null; // Columna 'eps'
    arl: number | null; // Columna 'arl'
    pension: number | null; // Columna 'pension'
    layoffs: number | null; // Columna 'layoffs'
    compensationbox: number | null; // Columna 'compensationbox'
    relationship: number | null;
    bonding_type: number | null;
    branch_id: number | null;
    city_birth: number | null;
    education_level: number | null;
    shoe_size: number | null;
    blood_type: number | null;

    family_document_type: number; // O relación si existe
    identificationcard_family: string;

    // Relaciones (Objetos completos para mostrar etiquetas)
    identification_data?: { id: number; description_identification: string };
    blood_type_data?: { id: number; blood_type_description: string };
    civil_status_data?: { id: number; description_maritalstatus: string };
    city_data?: { id: number; city_name: string };
    province_data?: { id: number; department_name: string };
    country_data?: { id: number; country_name: string };
    city_birth_data?: { id: number; city_name: string };
    bonding_data?: { id: number; bonding_type_description: string };
    charge_data?: { id: number; description_charge: string };
    work_area_data?: { id: number; workarea_description: string };
    usertype_data?: { id: number; description_usertype: string };
    company_data?: { id: number; name_company: string };
    branch_data?: { id: number; name_branch: string };
    health_entity_data?: { id: number; description_eps: string };
    arl_data?: { id: number; description_arl: string };
    pension_data?: { id: number; description_pension: string };
    layoffs_data?: { id: number; description_layoffs: string };
    compensation_box_data?: { id: number; description_compensationbox: string };
    relationship_data?: { id: number; description_relationship: string };
    shoe_size_data?: { id: number; description_shoesize: string };
    education_level_data?: { id: number; description_leveleducation: string };
}

interface EmployeesProps {
    employees: Employee[];
    catalogs: Catalogs;
}

type SetDataFunction = (field: keyof FormSchema, value: string | number) => void;

export default function Employees({ employees, catalogs }: EmployeesProps) {
    const { t } = useTranslation();
    const [activeMenuItem, setActiveMenuItem] = useState<string>(employees.length > 0 ? String(employees[0].id) : '');
    const [searchQuery, setSearchQuery] = useState('');

    const versions = [
        { id: 'view-all', label: 'Ver Todos', current: true },
        { id: 'active', label: 'Solo Activos', current: false },
    ];

    // Filtrado
    const filteredEmployees = useMemo(() => {
        if (!searchQuery) return employees;
        const lowerQuery = searchQuery.toLowerCase();
        return employees.filter(
            (emp) =>
                emp.firstname.toLowerCase().includes(lowerQuery) ||
                emp.lastname.toLowerCase().includes(lowerQuery) ||
                emp.identificationcard?.includes(lowerQuery) ||
                emp.username.toLowerCase().includes(lowerQuery),
        );
    }, [employees, searchQuery]);

    // Menú Sidebar
    const menuSections: MenuSection[] = useMemo(() => {
        return [
            {
                title: `Empleados (${filteredEmployees.length})`,
                items: filteredEmployees.map((emp) => ({
                    id: String(emp.id),
                    label: `${emp.firstname} ${emp.lastname}`,
                })),
            },
        ];
    }, [filteredEmployees]);

    const activeEmployee = useMemo(() => {
        return employees.find((e) => String(e.id) === activeMenuItem);
    }, [activeMenuItem, employees]);

    // --- RENDER INPUT ---
    // const RenderInput = ({
    //     label,
    //     field,
    //     type = 'text',
    //     data,
    //     setData,
    //     errors,
    // }: {
    //     label: string;
    //     field: keyof FormSchema;
    //     type?: string;
    //     data: FormSchema;
    //     setData: SetDataFunction;
    //     errors: Partial<Record<keyof FormSchema, string>>;
    // }) => (
    //     <div className="flex flex-col gap-1.5">
    //         <Label htmlFor={String(field)} className="text-xs font-medium text-gray-500 dark:text-gray-400">
    //             {label}
    //         </Label>
    //         <Input
    //             id={String(field)}
    //             type={type}
    //             value={data[field] !== null && data[field] !== undefined ? String(data[field]) : ''}
    //             onChange={(e) => setData(field, e.target.value)}
    //             className="-ml-2 h-6 rounded border-transparent bg-transparent px-2 text-sm font-medium text-gray-900 transition-all hover:border-gray-200 focus:border-blue-500 dark:text-gray-100"
    //             placeholder="-"
    //         />
    //         {errors[field] && <span className="text-xs text-red-500">{errors[field]}</span>}
    //     </div>
    // );

    const RenderInput = ({
        label,
        field,
        type = 'text',
        data,
        setData,
        errors,
        className = '', // Nuevo prop con valor por defecto
    }: {
        label: string;
        field: keyof FormSchema;
        type?: string;
        data: FormSchema;
        setData: SetDataFunction;
        errors: Partial<Record<keyof FormSchema, string>>;
        className?: string; // Definición de tipo
    }) => (
        <div className="flex w-full flex-col gap-1.5">
            {label && (
                <Label htmlFor={String(field)} className="text-xs font-medium text-gray-500 dark:text-gray-400">
                    {label}
                </Label>
            )}
            <Input
                id={String(field)}
                type={type}
                value={data[field] !== null && data[field] !== undefined ? String(data[field]) : ''}
                onChange={(e) => setData(field, e.target.value)}
                // Concatenamos las clases por defecto con las que recibimos
                className={`-ml-2 h-8 rounded border-transparent bg-transparent px-2 text-sm font-medium text-gray-900 transition-all hover:border-gray-200 focus:border-blue-500 dark:text-gray-100 ${className}`}
                placeholder="-"
            />
            {errors[field] && <span className="text-xs text-red-500">{errors[field]}</span>}
        </div>
    );

    const RenderSelect = ({
        label,
        field,
        options,
        labelKey,
        data,
        setData,
        errors,
        className = '',
    }: {
        label: string;
        field: keyof FormSchema;
        options: CatalogItem[];
        labelKey: string;
        data: FormSchema;
        setData: SetDataFunction;
        errors: Partial<Record<keyof FormSchema, string>>;
        className?: string;
    }) => (
        <div className="flex flex-col gap-1.5">
            <Label htmlFor={String(field)} className="text-xs font-medium text-gray-500 dark:text-gray-400">
                {label}
            </Label>
            <div className="relative">
                <select
                    id={String(field)}
                    // Convertimos el valor actual a String para asegurar coincidencia
                    value={data[field] ? String(data[field]) : ''}
                    onChange={(e) => setData(field, e.target.value)}
                    className={`-ml-2 h-8 w-full cursor-pointer appearance-none rounded border-none bg-transparent p-0 px-2 pr-8 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:ring-0 dark:text-gray-100 dark:hover:bg-gray-800 ${className}`}
                >
                    <option value="">Seleccionar...</option>
                    {options?.map((opt) => (
                        // IMPORTANTE: Forzamos el value de la opción a String
                        <option key={opt.id} value={String(opt.id)}>
                            {opt[labelKey]}
                        </option>
                    ))}
                </select>
            </div>
            {errors[field] && <span className="text-xs text-red-500">{errors[field]}</span>}
        </div>
    );

    const RenderTextArea = ({
        label,
        field,
        data,
        setData,
        errors,
        className = '',
        rows = 3,
    }: {
        label: string;
        field: keyof FormSchema;
        data: FormSchema;
        setData: SetDataFunction;
        errors: Partial<Record<keyof FormSchema, string>>;
        className?: string;
        rows?: number;
    }) => (
        <div className="flex w-full flex-col gap-1.5">
            <Label htmlFor={String(field)} className="text-xs font-medium text-gray-500 dark:text-gray-400">
                {label}
            </Label>
            <textarea
                id={String(field)}
                value={data[field] !== null && data[field] !== undefined ? String(data[field]) : ''}
                onChange={(e) => setData(field, e.target.value)}
                rows={rows} // Altura por defecto
                className={`w-full rounded-md border border-gray-200 bg-transparent p-2 text-sm font-medium text-gray-900 transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:text-gray-100 dark:focus:border-blue-500 ${className}`}
                placeholder="Escribe aquí..."
            />
            {errors[field] && <span className="text-xs text-red-500">{errors[field]}</span>}
        </div>
    );

    const RenderDatePicker = ({
        label,
        field,
        data,
        setData,
        errors,
        className = '',
    }: {
        label: string;
        field: keyof FormSchema;
        data: FormSchema;
        setData: SetDataFunction;
        errors: Partial<Record<keyof FormSchema, string>>;
        className?: string;
    }) => {
        // 1. Convertir String (BD) a Date (JS)
        const dateValue = data[field] && typeof data[field] === 'string' ? new Date(data[field] + 'T12:00:00') : undefined;

        // 2. Manejar selección
        const handleSelect = (newDate: Date | undefined) => {
            if (newDate) {
                const formattedDate = format(newDate, 'yyyy-MM-dd');
                setData(field, formattedDate);
            } else {
                setData(field, '');
            }
        };

        return (
            <div className="flex w-full flex-col gap-1.5">
                <Label htmlFor={String(field)} className="text-xs font-medium text-gray-500 dark:text-gray-400">
                    {label}
                </Label>

                <Popover>
                    <PopoverTrigger asChild>
                        <Button
                            variant={'outline'}
                            className={cn(
                                '-ml-2 h-8 w-full justify-start text-left text-sm font-medium',
                                'border-transparent bg-transparent shadow-none hover:border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800',
                                !dateValue && 'text-muted-foreground',
                                dateValue ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400',
                                className,
                            )}
                        >
                            {/* <CalendarIcon className="mr-2 h-3 w-3" /> */}
                            {dateValue ? format(dateValue, 'PPP', { locale: es }) : <span>Seleccionar fecha</span>}
                        </Button>
                    </PopoverTrigger>
                    {/* Quitamos overflow-hidden para que el focus ring se vea bien */}
                    <PopoverContent className="w-auto p-0" align="start">
                        <Calendar
                            mode="single"
                            selected={dateValue}
                            onSelect={handleSelect}
                            initialFocus
                            locale={es}
                            // Activamos el modo Dropdown
                            captionLayout="dropdown"
                            // Rango amplio para fechas de nacimiento
                            fromYear={1940}
                            toYear={new Date().getFullYear() + 5}
                            // --- ESTILOS PARA CORREGIR LA VISUALIZACIÓN ---
                            classNames={{
                                // 1. Ocultamos el título de texto (ej: "Enero 2026") para que solo queden los selects
                                caption_label: 'hidden',

                                // 2. Contenedor de los selects: Flex para ponerlos lado a lado
                                caption_dropdowns: 'flex w-full items-center justify-center gap-1.7',

                                // 3. Estilo de los contenedores de Mes y Año
                                dropdown_month: 'relative flex-1',
                                dropdown_year: 'relative min-w-[5rem]',

                                // 4. EL SELECT REAL:
                                // Usamos '!' para anular el 'absolute opacity-0' que trae shadcn por defecto.
                                // Le damos estilos de Input (borde, rounded, bg-transparent)
                                dropdown: cn(
                                    '!relative !inset-auto !flex !h-8 !w-full !appearance-none !p-0 !pr-6 !pl-8 !text-sm !font-medium',
                                    'rounded-md border border-input shadow-sm transition-colors',
                                    'hover:bg-accent hover:text-accent-foreground',
                                    'focus:ring-1 focus:ring-ring focus:outline-none',
                                ),

                                // 5. Ajuste del icono de la flecha del select (opcional, react-day-picker a veces lo renderiza)
                                dropdown_icon: 'absolute right-2 top-1/2 -translate-y-1/2 size-4 opacity-50 pointer-events-none',
                            }}
                        />
                    </PopoverContent>
                </Popover>

                {errors[field] && <span className="text-xs text-red-500">{errors[field]}</span>}
            </div>
        );
    };
    const EmployeeForm = ({ employee }: { employee: Employee }) => {
        // Inicializamos useForm al estilo company-info.tsx
        // IMPORTANTE: Mapeamos los objetos del empleado a IDs planos para el formulario
        const { data, setData, put, processing, isDirty, reset, errors } = useForm<FormSchema>({
            id: employee.id,
            firstname: employee.firstname || '',
            lastname: employee.lastname || '',
            motherslastname: employee.motherslastname || '',
            secondname: employee.secondname || '',
            email: employee.email || '',
            identificationcard: employee.identificationcard || '',
            user_status: employee.user_status || '1',

            identification: employee.identification || '', // Antes pusiste identificationData
            city: employee.city || '', // Antes pusiste cityData
            department: employee.department || '', // Antes pusiste department (Esto estaba bien, pero mantén el orden)
            country: employee.country || '',
            charge: employee.charge || '',
            work_area: employee.work_area || '',
            civil_status: employee.civil_status || '',
            usertype: employee.usertype || '',

            // Ojo aquí: En FormSchema le llamaste 'bonding', pero en employee viene como 'bonding_type'
            bonding: employee.bonding_type || '',

            eps: employee.eps || '',
            arl: employee.arl || '',
            pension: employee.pension || '',
            layoffs: employee.layoffs || '',
            compensationbox: employee.compensationbox || '',

            branch: employee.branch_id || '',
            cityBirth: employee.city_birth || '',
            educationLevel: employee.education_level || '',
            relationship: employee.relationship || '',
            shoeSize: employee.shoe_size || '',
            bloodType: employee.blood_type || '',

            // Campos de texto y fechas
            address: employee.address || '',
            phone: employee.phone || '',
            phone_cellular: employee.phone_cellular || '',
            user_entry_date: employee.user_entry_date || '',
            salary: employee.salary || 0,
            aid_transport: employee.aid_transport || 0,
            place_expedition_identificationcard: employee.place_expedition_identificationcard || '',

            type_sex: employee.type_sex || '',
            functions_performed: employee.functions_performed || '',

            date_eps: employee.date_eps || '',
            arl_date: employee.arl_date || '',
            date_pension: employee.date_pension || '',
            date_layoffs: employee.date_layoffs || '',
            date_compensationbox: employee.date_compensationbox || '',

            // Familia / Contacto Emergencia
            family_names: employee.family_names || '',
            family_document_type: employee.family_document_type || 0,
            identificationcard_family: employee.identificationcard_family || '',
            family_address: employee.family_address || '',
            family_phone: employee.family_phone || '',
            family_phone_cellular: employee.family_phone_cellular || '',

            // Dotación
            weight: employee.weight || 0,
            shirt_size: employee.shirt_size || '',
            pant_size: employee.pant_size || 0,

            // Educación
            educational_institution: employee.educational_institution || '',
            last_course: employee.last_course || '',
            study_end_date: employee.study_end_date || '',
            obtained_title: employee.obtained_title || '',

            // Experiencia Pasada
            last_company_name: employee.last_company_name || '',
            charges_last_company: employee.charges_last_company || '',
            start_date_last_company: employee.start_date_last_company || '',
            date_end_last_company: employee.date_end_last_company || '',
        });

        const handleSubmit = (e: React.FormEvent) => {
            e.preventDefault();

            // Usamos route() globalmente definido o put('/path') directo
            // put(route('users.updateEmployees', employee.id), {
            put(`/humanResources/users/employees/${employee.id}`, {
                preserveScroll: true,
                onSuccess: () => {
                    MySwal.fire({
                        icon: 'success',
                        title: 'Actualizado',
                        text: 'Información guardada correctamente.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                },
                onError: () => {
                    console.error('Errores de validación recibidos:', errors); // Míralos en la consola (F12)

                    // Convertimos el objeto de errores en una lista HTML legible
                    const errorMessages = Object.values(errors)
                        .map((err) => `<li>${err}</li>`)
                        .join('');

                    MySwal.fire({
                        icon: 'error',
                        title: 'Error de Validación',
                        html: `
                            <p>No se pudo guardar por los siguientes motivos:</p>
                            <ul style="text-align: left; margin-top: 10px; font-size: 0.9em; color: #dc2626;">
                                ${errorMessages}
                            </ul>
                        `,
                    });
                },
            });
        };

        const handleSetData: SetDataFunction = (field, value) => {
            setData(field, value);
        };

        // Helpers visuales (usando los datos del PROPS employee para mostrar nombres, no IDs)
        // const formatCurrency = (amount?: number) => {
        //     if (amount === undefined || amount === null) return '-';
        //     return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 }).format(amount);
        // };

        const formatDate = (dateString?: string) => {
            if (!dateString) return '-';
            return new Date(dateString).toLocaleDateString('es-CO');
        };

        const renderLabelValue = (label: string, value: string | number | undefined | null) => (
            <div className="flex flex-col gap-0.5">
                <dt className="text-xs font-medium text-gray-500 dark:text-gray-400">{label}</dt>
                <dd className="min-h-[1.25rem] truncate text-sm font-medium text-gray-900 dark:text-gray-100">{value || '-'}</dd>
            </div>
        );

        const fullName = `${employee.firstname} ${employee.secondname || ''} ${employee.lastname} ${employee.motherslastname || ''}`;

        return (
            <form onSubmit={handleSubmit} className="relative space-y-6 pb-20 duration-300 animate-in fade-in">
                {/* --- Header --- */}
                <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div className="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div className="flex gap-4">
                            <div className="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-blue-600 text-xl font-bold text-white shadow-md">
                                {data.firstname[0]}
                                {data.lastname[0]}
                            </div>
                            <div>
                                <h2 className="text-2xl font-bold text-gray-900 dark:text-white">{fullName}</h2>
                                <p className="text-sm text-gray-500 dark:text-gray-400">{employee.email}</p>
                                <div className="mt-2 flex flex-wrap gap-2">
                                    <Badge
                                        variant="outline"
                                        className="border-blue-200 bg-blue-50 text-blue-700 dark:border-blue-800 dark:bg-blue-900/30 dark:text-blue-300"
                                    >
                                        {employee.charge_data?.description_charge || 'Sin Cargo'}
                                    </Badge>
                                    <Badge
                                        variant="outline"
                                        className="border-gray-200 bg-gray-50 text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                    >
                                        {employee.company_data?.name_company || 'Sin Empresa'}
                                    </Badge>
                                    <Badge
                                        variant="outline"
                                        className="border-gray-200 bg-gray-50 text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                    >
                                        {employee.usertype_data?.description_usertype}
                                    </Badge>
                                    <Badge
                                        variant="outline"
                                        className="border-gray-200 bg-gray-50 text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                    >
                                        {employee.id}
                                    </Badge>
                                </div>
                            </div>
                        </div>
                        <div className="flex flex-col items-end gap-2">
                            <Badge className={employee.user_status === '2' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600'}>
                                {employee.user_status === '2' ? 'ACTIVO' : 'INACTIVO'}
                            </Badge>
                            <span className="text-ms font-mono text-gray-400">Nombre de Usuario: {employee.username}</span>
                        </div>
                    </div>
                </div>

                <div className="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    {/* 1. Información Personal */}
                    <div className="rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <UserIcon className="h-4 w-4" /> Información Personal
                        </h3>
                        <dl className="grid grid-cols-2 gap-x-4 gap-y-4">
                            <div className="col-span-2">
                                <RenderSelect
                                    label="*Tipo Documento"
                                    field="identification"
                                    options={catalogs.identifications}
                                    labelKey="description_identification"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                />
                            </div>
                            <div className="col-span-2">{renderLabelValue('No. Documento', employee.identificationcard)}</div>
                            {/* {renderLabelValue('Lugar Expedición', employee.place_expedition_identificationcard)} */}

                            <RenderInput
                                label="Lugar Expedición"
                                field="place_expedition_identificationcard"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />
                            {renderLabelValue('Sexo', employee.type_sex === 'M' ? 'Masculino' : 'Femenino')}
                            {renderLabelValue('Fecha Nacimiento', dayjs(employee.birthdate).format('dddd, D [de] MMMM [de] YYYY'))}
                            {/* {dayjs(company?.subscription_start_at).format('dddd, D [de] MMMM [de] YYYY')} */}
                            {renderLabelValue('Edad', employee.age ? `${employee.age} años` : '-')}

                            {/* {renderLabelValue('Grupo Sanguíneo', employee.blood_type_data?.blood_type_description)} */}
                            <RenderSelect
                                label="Seleccionar Grupo Sanguíneo"
                                field="bloodType"
                                options={catalogs.bloodTypes}
                                labelKey="blood_type_description"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />
                            {/* {renderLabelValue('Estado Civil', employee.civil_status_data?.description_maritalstatus)} */}
                            <RenderSelect
                                label="Estado Civil"
                                field="civil_status"
                                options={catalogs.civilStatuses}
                                labelKey="description_maritalstatus"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />
                        </dl>
                    </div>

                    {/* 2. Ubicación y Contacto */}
                    <div className="rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <MapPin className="h-4 w-4" /> Ubicación y Contacto
                        </h3>
                        <dl className="grid grid-cols-2 gap-x-4 gap-y-4">
                            <div className="col-span-2">
                                <RenderTextArea
                                    label="Dirección Residencia"
                                    field="address"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                    rows={2}
                                    className="resize-none"
                                />
                            </div>
                            {/* {renderLabelValue('País', employee.country_data?.country_name)} */}
                            <RenderSelect
                                label="Seleccionar el Pais residencial"
                                field="country"
                                options={catalogs.countries}
                                labelKey="country_name"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />
                            {/* {renderLabelValue('Departamento', employee.province_data?.department_name)} */}
                            <RenderSelect
                                label="Seleccionar Departamento residencial"
                                field="department"
                                options={catalogs.Provinces}
                                labelKey="department_name"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />
                            {/* {renderLabelValue('Ciudad', employee.city_data?.city_name)} */}
                            <RenderSelect
                                label="Seleccionar la Ciudad de residencia"
                                field="city"
                                options={catalogs.cities}
                                labelKey="city_name"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />

                            {/* {renderLabelValue('Ciudad Nacimiento', employee.city_birth_data?.city_name || '-')} */}
                            <RenderSelect
                                label="Seleccionar la Ciudad de Nacimiento"
                                field="cityBirth"
                                options={catalogs.cities}
                                labelKey="city_name"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />
                            {/* {renderLabelValue('Teléfono Fijo', employee.phone)} */}
                            {/* {renderLabelValue('Celular', employee.phone_cellular)} */}
                            <RenderInput label="Teléfono Fijo" field="phone" data={data} setData={handleSetData} errors={errors} />
                            <RenderInput label="Celular" field="phone_cellular" data={data} setData={handleSetData} errors={errors} />
                        </dl>
                    </div>

                    {/* 3. Información Laboral */}
                    <div className="rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <Briefcase className="h-4 w-4" /> Datos Contractuales
                        </h3>
                        <dl className="grid grid-cols-2 gap-x-4 gap-y-4">
                            <div className="col-span-2">
                                {/* {renderLabelValue('Cargo', employee.charge?.description_charge)} */}
                                <RenderSelect
                                    label="Seleccionar Cargo"
                                    field="charge"
                                    options={catalogs.charges}
                                    labelKey="description_charge"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                />
                            </div>
                            {/* {renderLabelValue('Area', employee.work_area_data?.workarea_description)} */}
                            {/* <RenderInput label="Area de Trabajo" field="work_area" data={data} setData={handleSetData} errors={errors} /> */}

                            {/* {renderLabelValue('Cargo', employee.charge?.description_charge)} */}
                            <RenderSelect
                                label="Seleccionar Area de Trabajo"
                                field="work_area"
                                options={catalogs.workAreas}
                                labelKey="workarea_description"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />

                            {/* {renderLabelValue('Tipo Usuario', employee.usertype_data?.description_usertype)} */}

                            {/* {renderLabelValue('Tipo Vinculación', employee.bonding_data?.bonding_type_description)} */}
                            {/* <RenderInput label="Tipo Vinculación" field="bonding" data={data} setData={handleSetData} errors={errors} /> */}

                            {renderLabelValue('Sede / Sucursal', employee.branch_data?.name_branch)}
                            {renderLabelValue('Fecha Ingreso', dayjs(employee.user_entry_date).format('dddd, D [de] MMMM [de] YYYY'))}

                            <RenderSelect
                                label="Seleccionar Tipo Vinculación"
                                field="bonding"
                                options={catalogs.bondings}
                                labelKey="bonding_type_description"
                                data={data}
                                setData={handleSetData}
                                errors={errors}
                            />

                            {/* <div className="col-span-2 mt-2 rounded bg-white p-3 shadow-sm dark:bg-gray-800">
                                <p className="text-xs text-gray-500">Salario Básico</p>
                                <p className="text-lg font-bold text-green-600 dark:text-green-400">{formatCurrency(employee.salary)}</p>
                                <div className="mt-1 flex justify-between border-t border-gray-100 pt-1 dark:border-gray-700">
                                    <span className="text-xs text-gray-500">Aux. Transporte:</span>
                                    <span className="text-xs font-medium">{formatCurrency(employee.aid_transport)} </span>
                                </div>
                            </div> */}

                            <div className="col-span-2 mt-2 rounded bg-white p-3 shadow-sm dark:bg-gray-800">
                                {/* CAMPO SALARIO */}
                                <div className="mb-2">
                                    <p className="mb-1 text-xs text-gray-500">Salario Básico</p>

                                    {/* CAMBIO: Agregamos 'gap-2' para separar el icono del input */}
                                    <div className="flex items-center gap-2">
                                        <span className="text-lg font-bold text-green-600 dark:text-green-400">$</span>

                                        <RenderInput
                                            label=""
                                            field="salary"
                                            type="number"
                                            data={data}
                                            setData={handleSetData}
                                            errors={errors}
                                            // CLASES: Mantenemos el estilo
                                            className="!h-auto border-none bg-transparent !p-0 !text-lg font-bold text-green-600 shadow-none focus:border-none focus:ring-0 dark:text-green-400"
                                        />
                                    </div>
                                </div>

                                {/* CAMPO AUXILIO TRANSPORTE */}
                                <div className="mt-1 flex items-center justify-between border-t border-gray-100 pt-2 dark:border-gray-700">
                                    <span className="text-xs text-gray-500">Aux. Transporte:</span>

                                    <div className="flex flex-1 items-center justify-end gap-1">
                                        <span className="text-xs font-medium text-gray-900 dark:text-gray-100">$</span>

                                        <div className="w-24">
                                            <RenderInput
                                                label=""
                                                field="aid_transport"
                                                type="number"
                                                data={data}
                                                setData={handleSetData}
                                                errors={errors}
                                                // Input alineado a la derecha
                                                className="!h-auto border-none bg-transparent !p-0 text-right text-xs font-medium text-gray-900 shadow-none focus:border-none focus:ring-0 dark:text-gray-100"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* {renderLabelValue('Código Cía.', employee.code_company)} */}
                            {employee.date_refund ? renderLabelValue('Fecha Retiro', formatDate(employee.date_refund)) : null}
                        </dl>
                    </div>

                    {/* 5. Familia y Emergencia */}
                    <div className="rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <Users className="h-4 w-4" /> Contacto Familiar
                        </h3>
                        <dl className="grid grid-cols-1 gap-y-3">
                            <div className="col-span-2">
                                <RenderSelect
                                    label="*Tipo Documento"
                                    field="family_document_type"
                                    options={catalogs.identifications}
                                    labelKey="description_identification"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                />
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                {renderLabelValue('No. Documento', employee.identificationcard_family)}

                                <RenderSelect
                                    label="*Tipo Documento"
                                    field="relationship"
                                    options={catalogs.relationships}
                                    labelKey="description_relationship"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                />
                            </div>
                            <div className="col-span-2">
                                <RenderInput label="Nombre Familiar" field="family_names" data={data} setData={handleSetData} errors={errors} />
                            </div>

                            <div className="grid grid-cols-2 gap-4">
                                {renderLabelValue('Teléfono', employee.family_phone)}
                                {renderLabelValue('Celular', employee.family_phone_cellular)}
                            </div>
                            <div className="col-span-2">
                                <RenderInput label="Dirección" field="family_address" data={data} setData={handleSetData} errors={errors} />
                            </div>
                        </dl>
                    </div>

                    {/* 6. Dotación y Tallas */}
                    <div className="rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <Ruler className="h-4 w-4" /> Tallas y Dotación
                        </h3>
                        <div className="grid grid-cols-2 gap-4">
                            <div className="flex flex-col items-center justify-center rounded bg-white p-2 text-center dark:bg-gray-800">
                                <span className="text-xs text-gray-500">Camisa</span>
                                <RenderInput
                                    label="" // Sin label porque usamos el span de arriba
                                    field="shirt_size"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                    // CLASES: text-center, font-bold, text-2xl (más grande), sin margen negativo
                                    className="!ml-0 text-center !text-xl font-bold"
                                />
                            </div>
                            <div className="flex flex-col items-center justify-center rounded bg-white p-2 text-center dark:bg-gray-800">
                                <span className="text-xs text-gray-500">Pantalón</span>
                                <RenderInput
                                    label=""
                                    field="pant_size"
                                    type="number"
                                    data={data}
                                    setData={handleSetData}
                                    errors={errors}
                                    // CLASES: Mantenemos el estilo
                                    className="!ml-0 text-center !text-xl font-bold"
                                />
                            </div>
                            <div className="flex flex-col items-center justify-center rounded bg-white p-2 text-center dark:bg-gray-800">
                                <span className="text-xs text-gray-500">Calzado</span>
                                <span className="text-lg font-bold">
                                    <RenderSelect
                                        label=""
                                        field="shoeSize"
                                        options={catalogs.shoeSizes}
                                        labelKey="description_shoesize"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                        className="!ml-0 text-center !text-xl font-bold"
                                    />
                                </span>
                            </div>
                            <div className="flex flex-col items-center justify-center rounded bg-white p-2 text-center dark:bg-gray-800">
                                <span className="text-xs text-gray-500">Peso (kg)</span>

                                {employee.weight ? (
                                    <RenderInput
                                        label=""
                                        field="weight"
                                        type="number"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                        className="!ml-0 text-center !text-xl font-bold"
                                    />
                                ) : (
                                    '-'
                                )}
                            </div>
                        </div>
                    </div>
                    {/* 5. Familia y Emergencia */}
                    <div className="rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <Users className="h-4 w-4" /> Contacto Familiar
                        </h3>
                        <dl className="grid grid-cols-1 gap-y-3">
                            {renderLabelValue('Nombre Familiar', employee.family_names)}
                            {renderLabelValue('Parentesco', employee.relationship_data?.description_relationship)}
                            <div className="grid grid-cols-2 gap-4">
                                {renderLabelValue('Teléfono', employee.family_phone)}
                                {renderLabelValue('Celular', employee.family_phone_cellular)}
                            </div>
                            {renderLabelValue('Dirección', employee.family_address)}
                        </dl>
                    </div>

                    {/* 4. Seguridad Social (Card Ancha) */}
                    <div className="col-span-1 rounded-xl border border-gray-200 bg-gray-50 p-5 md:col-span-2 xl:col-span-3 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <HeartPulse className="h-4 w-4" /> Seguridad Social y Afiliaciones
                        </h3>
                        <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <div className="rounded-lg bg-white p-3 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-blue-600 dark:text-blue-400">EPS (Salud)</div>
                                <div className="text-sm font-medium">
                                    {/* {employee.health_entity_data?.description_eps || 'No registrada'} */}
                                    <RenderSelect
                                        label=""
                                        field="eps"
                                        options={catalogs.healthEntities}
                                        labelKey="description_eps"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                                <div className="text-xs text-gray-400">
                                    {/* {formatDate(employee.date_eps)} */}
                                    <RenderDatePicker label="Fecha EPS" field="date_eps" data={data} setData={handleSetData} errors={errors} />
                                </div>
                            </div>
                            <div className="rounded-lg bg-white p-3 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-orange-600 dark:text-orange-400">Fondo Pensiones</div>
                                <div className="text-sm font-medium">
                                    {/* {employee.pension_data?.description_pension || 'No registrado'} */}
                                    <RenderSelect
                                        label=""
                                        field="pension"
                                        options={catalogs.pensions}
                                        labelKey="description_pension"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                                <div className="text-xs text-gray-400">
                                    {/* {formatDate(employee.date_pension)} */}
                                    <RenderDatePicker
                                        label="Fecha Pensiones"
                                        field="date_pension"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                            </div>
                            <div className="rounded-lg bg-white p-3 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-red-600 dark:text-red-400">ARL (Riesgos)</div>
                                <div className="text-sm font-medium">
                                    {/* {employee.arl_data?.description_arl || 'No registrada'} */}
                                    <RenderSelect
                                        label=""
                                        field="arl"
                                        options={catalogs.arls}
                                        labelKey="description_arl"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                                <div className="text-xs text-gray-400">
                                    {/* {formatDate(employee.arl_date)} */}
                                    <RenderDatePicker label="Fecha ARL" field="arl_date" data={data} setData={handleSetData} errors={errors} />
                                </div>
                            </div>
                            <div className="rounded-lg bg-white p-3 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-purple-600 dark:text-purple-400">Caja Compensación</div>
                                <div className="text-sm font-medium">
                                    {/* {employee.compensation_box_data?.description_compensationbox || 'No registrada'} */}
                                    <RenderSelect
                                        label=""
                                        field="compensationbox"
                                        options={catalogs.compensationBoxes}
                                        labelKey="description_compensationbox"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                                <div className="text-xs text-gray-400">
                                    {/* {formatDate(employee.date_compensationbox)} */}
                                    <RenderDatePicker
                                        label="Fecha EPS"
                                        field="date_compensationbox"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                            </div>
                            <div className="rounded-lg bg-white p-3 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-teal-600 dark:text-teal-400">Fondo Cesantías</div>
                                <div className="text-sm font-medium">
                                    {/* {employee.layoffs_data?.description_layoffs || 'No registrado'} */}
                                    <RenderSelect
                                        label=""
                                        field="layoffs"
                                        options={catalogs.layoffs}
                                        labelKey="description_layoffs"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                                <div className="text-xs text-gray-400">
                                    {/* {formatDate(employee.date_layoffs)} */}
                                    <RenderDatePicker
                                        label="Fecha Fondo Cesantías"
                                        field="date_layoffs"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                </div>
                            </div>
                            {/* 6. Medicina Prepagada (Ejemplo Harcodeado) */}
                            <div className="rounded-lg bg-white p-3 opacity-70 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-pink-600 dark:text-pink-400">Medicina Prepagada</div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    {/* Select Falso (Visualmente idéntico) */}
                                    <div className="-ml-2 flex h-8 w-full cursor-not-allowed items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Colmedica (Demo)
                                    </div>
                                </div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <label className="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha Afiliación</label>
                                    <div className="-ml-2 flex h-8 w-full items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        <span className="mr-2">📅</span> 15 de Enero de 2026
                                    </div>
                                </div>
                            </div>

                            {/* 7. Seguro de Vida (Ejemplo Harcodeado) */}
                            <div className="rounded-lg bg-white p-3 opacity-70 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-indigo-600 dark:text-indigo-400">Seguro de Vida</div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <div className="-ml-2 flex h-8 w-full cursor-not-allowed items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Sura Global (Demo)
                                    </div>
                                </div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <label className="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha Inicio</label>
                                    <div className="-ml-2 flex h-8 w-full items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        <span className="mr-2">📅</span> 20 de Febrero 2026
                                    </div>
                                </div>
                            </div>

                            {/* 8. Plan Exequial (Ejemplo Harcodeado) */}
                            <div className="rounded-lg bg-white p-3 opacity-70 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-emerald-600 dark:text-emerald-400">Plan Exequial</div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <div className="-ml-2 flex h-8 w-full cursor-not-allowed items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Los Olivos (Demo)
                                    </div>
                                </div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <label className="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha Registro</label>
                                    <div className="-ml-2 flex h-8 w-full items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        <span className="mr-2">📅</span> 01 de Marzo 2026
                                    </div>
                                </div>
                            </div>
                            <div className="rounded-lg bg-white p-3 opacity-70 shadow-sm dark:bg-gray-800">
                                <div className="text-xs font-bold text-emerald-600 dark:text-emerald-400">Plan Exequial</div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <div className="-ml-2 flex h-8 w-full cursor-not-allowed items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Los Olivos (Demo)
                                    </div>
                                </div>
                                <div className="mt-1 flex flex-col gap-1.5">
                                    <label className="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha Registro</label>
                                    <div className="-ml-2 flex h-8 w-full items-center px-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        <span className="mr-2">📅</span> 01 de Marzo 2026
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* 7. Educación y Experiencia (Ancha abajo) */}
                    <div className="col-span-1 rounded-xl border border-gray-200 bg-gray-50 p-5 md:col-span-2 xl:col-span-3 dark:border-gray-700 dark:bg-gray-800/50">
                        <h3 className="mb-4 flex items-center gap-2 border-b border-gray-200 pb-2 text-sm font-bold tracking-wider text-gray-700 uppercase dark:border-gray-700 dark:text-gray-200">
                            <GraduationCap className="h-4 w-4" /> Formación y Experiencia Previa
                        </h3>
                        <div className="grid gap-6 md:grid-cols-2">
                            <div className="space-y-3">
                                <h4 className="text-xs font-semibold text-blue-600 uppercase dark:text-blue-400">Experiencia Educativa</h4>
                                <dl className="grid grid-cols-2 gap-4">
                                    <div className="col-span-2">
                                        {/* {renderLabelValue('Institución', employee.educational_institution)} */}
                                        <RenderInput
                                            label="Institución"
                                            field="educational_institution"
                                            data={data}
                                            setData={handleSetData}
                                            errors={errors}
                                        />
                                    </div>
                                    {/* {renderLabelValue('Nivel', employee.education_level_data?.description_leveleducation)} */}
                                    <RenderSelect
                                        label="*Seleccionar Nivel de Educación"
                                        field="educationLevel"
                                        options={catalogs.educationLevels}
                                        labelKey="description_leveleducation"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                    {/* {renderLabelValue('Título', employee.obtained_title)} */}
                                    <RenderInput
                                        label="Título Profesional Obtenido"
                                        field="obtained_title"
                                        data={data}
                                        setData={handleSetData}
                                        errors={errors}
                                    />
                                    {renderLabelValue('Último curso', employee.last_course)}
                                    {/* {renderLabelValue('Fecha Fin', formatDate(employee.study_end_date))} */}
                                    <RenderDatePicker label="Fecha Fin" field="study_end_date" data={data} setData={handleSetData} errors={errors} />
                                </dl>
                            </div>
                            <div className="space-y-3 border-t border-gray-200 pt-4 md:border-t-0 md:border-l md:pt-0 md:pl-6 dark:border-gray-700">
                                <h4 className="text-xs font-semibold text-blue-600 uppercase dark:text-blue-400">
                                    EXPERIENCIA LABORAL / Último Empleo
                                </h4>
                                <dl className="grid grid-cols-2 gap-4">
                                    <div className="col-span-2">
                                        {/* {renderLabelValue('Empresa', employee.last_company_name)} */}
                                        <RenderInput label="Empresa" field="last_company_name" data={data} setData={handleSetData} errors={errors} />
                                    </div>
                                    <dl className="grid grid-cols-2 gap-4">
                                        {/* {renderLabelValue('Cargo', employee.charges_last_company)} */}
                                        <RenderInput label="Cargo" field="charges_last_company" data={data} setData={handleSetData} errors={errors} />
                                        <div className="col-span-2 flex gap-2">
                                            {/* {renderLabelValue('Desde', formatDate(employee.start_date_last_company))} */}
                                            <RenderDatePicker
                                                label="Desde"
                                                field="start_date_last_company"
                                                data={data}
                                                setData={handleSetData}
                                                errors={errors}
                                            />
                                            <span className="self-center">-</span>
                                            {/* {renderLabelValue('Hasta', formatDate(employee.date_end_last_company))} */}
                                            <RenderDatePicker
                                                label="Fecha Fin"
                                                field="date_end_last_company"
                                                data={data}
                                                setData={handleSetData}
                                                errors={errors}
                                            />
                                        </div>
                                    </dl>
                                    <div className="col-span-2">
                                        {/* {renderLabelValue('Funciones', employee.functions_performed)} */}
                                        <RenderTextArea
                                            label="Funciones Desempeñadas"
                                            field="functions_performed"
                                            data={data}
                                            setData={handleSetData}
                                            errors={errors}
                                            className="min-h-[80px]" // Clase opcional para altura mínima
                                        />
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                {/* BOTÓN FLOTANTE */}
                <div
                    className={`fixed right-8 bottom-8 z-50 transform transition-all duration-300 ${
                        isDirty ? 'translate-y-0 opacity-100' : 'pointer-events-none translate-y-20 opacity-0'
                    }`}
                >
                    <button
                        type="submit"
                        disabled={processing}
                        className="flex items-center gap-2 rounded-full bg-black px-6 py-3 font-semibold text-white shadow-2xl transition-transform hover:scale-105 disabled:opacity-70 dark:bg-white dark:text-black"
                    >
                        {processing ? <span className="mr-1 animate-spin">⏳</span> : <Save className="h-5 w-5" />}
                        {processing ? 'Guardando...' : 'Actualizar Cambios'}
                    </button>
                    <button
                        type="button"
                        onClick={() => reset()}
                        className="absolute -top-2 -left-2 rounded-full bg-red-500 p-1 text-white shadow-md hover:bg-red-600"
                        title="Deshacer cambios"
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74-2.74L3 12" />
                        </svg>
                    </button>
                </div>
            </form>
        );
    };

    return (
        <AppLayout>
            <Head title={t('Employees')} />
            <SidebarLayout
                title={t('Employees')}
                version="v1.0"
                versions={versions}
                menuSections={menuSections}
                activeMenuItem={activeMenuItem}
                onMenuItemChange={setActiveMenuItem}
                searchPlaceholder="Buscar por nombre o cédula..."
                onSearch={setSearchQuery}
            >
                {renderContent()}
            </SidebarLayout>
        </AppLayout>
    );
    function renderContent() {
        if (!activeEmployee) {
            return (
                <div className="flex h-full flex-col items-center justify-center text-gray-500">
                    <UserIcon className="mb-4 h-16 w-16 opacity-20" />
                    <h2 className="text-xl font-semibold">Selecciona un empleado</h2>
                </div>
            );
        }
        // return <EmployeeForm key={`${activeEmployee.id}-${JSON.stringify(activeEmployee)}`} employee={activeEmployee} />;
        return <EmployeeForm key={activeEmployee.id} employee={activeEmployee} />;
    }
}
