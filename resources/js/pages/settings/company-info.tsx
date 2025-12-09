import { ImagePreview } from '@/components/image-preview';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { MySwal } from '@/lib/swal';
import { Head, useForm } from '@inertiajs/react';
import { Label } from '@radix-ui/react-label';
import dayjs from 'dayjs';
import 'dayjs/locale/es';
import localizedFormat from 'dayjs/plugin/localizedFormat';
import { Combobox, ComboboxItem } from '../../components/combobox';

dayjs.locale('es');
dayjs.extend(localizedFormat);

interface Company {
    id: number;
    code_company: string;
    name_company: string;
    nit_company: string;
    acronym_company: string | null;
    economic_activity_code: string;
    legal_representative: string | null;
    legal_representative_identification: string | null;
    legal_representative_document: string | null;
    legal_representative_expedition_identificationcard: string | null;
    address_representative_legal: string | null;
    phone_representative_legal: string | null;
    email_representative_legal: string | null;
    digital_signature_legal_representative: string | null;
    legal_nature: string | null;
    address_company: string | null;
    phone_company: string | null;
    email_company: string | null;
    website_company: string | null;
    scope_company: string | null;
    description_company: string | null;
    country_company: string | null;
    province_company: string | null;
    city_company: string | null;
    mission_company: string | null;
    vision_company: string | null;
    values_company: string | null;
    postal_code_company: string | null;
    number_employees: number | null;
    number_branches: number | null;
    status_company: string;
    plans_company: string;
    trial_ends_at: string | null;
    subscription_start_at: string | null;
    process_map_url?: string | null; // URL del Mapa de Procesos
    company_logo_url?: string | null; // URL del Logo de la Empresa
}

// interface EconomicActivity {
//     code: string;
//     name: string;
// }

interface CompanyInfoProps {
    company: Company;
    economicActivities: ComboboxItem[]; // Usamos la interfaz genérica
    identifications: ComboboxItem[]; // Nueva prop
    provinces: ComboboxItem[]; // Nueva prop
    cities: ComboboxItem[]; // Nueva prop
    filters: {
        search_activity: string | null;
    };
}

export default function CompanyInfo({ company, economicActivities, identifications, provinces, cities, filters }: CompanyInfoProps) {
    const { data, setData, put, processing, errors, isDirty } = useForm({
        name_company: company?.name_company || '',
        nit_company: company?.nit_company || '',
        acronym_company: company?.acronym_company || '',
        economic_activity_code: company?.economic_activity_code || 0,
        legal_representative: company?.legal_representative || '',
        legal_representative_identification: company?.legal_representative_identification || '',
        legal_representative_document: company?.legal_representative_document || '',
        legal_representative_expedition_identificationcard: company?.legal_representative_expedition_identificationcard || '',
        address_representative_legal: company?.address_representative_legal || '',
        phone_representative_legal: company?.phone_representative_legal || '',
        email_representative_legal: company?.email_representative_legal || '',
        digital_signature_legal_representative: company?.digital_signature_legal_representative || '',
        legal_nature: company?.legal_nature || '',
        address_company: company?.address_company || '',
        phone_company: company?.phone_company || '',
        email_company: company?.email_company || '',
        website_company: company?.website_company || '',
        scope_company: company?.scope_company || '',
        description_company: company?.description_company || '',
        country_company: company?.country_company || '',
        province_company: company?.province_company || '',
        city_company: company?.city_company || '',
        mission_company: company?.mission_company || '',
        vision_company: company?.vision_company || '',
        values_company: company?.values_company || '',
        postal_code_company: company?.postal_code_company || '',
        number_employees: company?.number_employees || 0,
        number_branches: company?.number_branches || 0,
    });

    // Manejar el cambio del select
    const handleEconomicActivityChange = (value: string) => {
        setData('economic_activity_code', value);
    };

    // Handler para Identificación (¡Mucho más simple!)
    const handleIdentificationChange = (value: string) => {
        setData('legal_representative_identification', value); // Asumiendo que este es el campo a guardar
    };

    const handleProvinceChange = (value: string) => {
        setData('province_company', value); // Asumiendo que este es el campo a guardar
    };

    const handleCityChange = (value: string) => {
        setData('city_company', value); // Asumiendo que este es el campo a guardar
    };

    const plans = { b: 'Básico', m: 'Medio', p: 'Premium' };

    const planColors = { b: 'text-green-500', m: 'text-blue-500', p: 'text-amber-500' };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        put('/settings/company-info', {
            preserveScroll: true,
            onSuccess: () => {
                MySwal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La información de la empresa ha sido actualizada correctamente',
                    timer: 2000,
                    showConfirmButton: false,
                });
            },
            onError: (errors) => {
                console.error('Errores de validación:', errors);
                MySwal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar la información',
                });
            },
        });
    };

    return (
        <AppLayout>
            <Head title="Información de la Empresa" />
            <div className="flex h-[calc(100vh-3.6rem)] w-full flex-col bg-white dark:bg-[#1a1a1a]">
                <form onSubmit={handleSubmit} className="flex h-full flex-col overflow-hidden">
                    <div className="flex-1 overflow-y-auto p-4 sm:p-6">
                        <div className="space-y-6">
                            {/* Header con logo e información */}
                            <div className="grid grid-cols-1 gap-4 lg:grid-cols-[auto_1fr_auto_auto]">
                                {/* Imagen del Mapa de Procesos */}
                                {/* <div className="flex h-24 w-32 items-center justify-center rounded-lg border-2 border-white bg-white text-center text-xs text-black">
                                    Imagen del Mapa de procesos
                                </div> */}
                                <ImagePreview
                                    src={company?.process_map_url} // <--- Aquí pon: company.process_map_url o la URL real
                                    alt="Mapa de Procesos"
                                    label="Imagen del Mapa de procesos"
                                />

                                {/* Nombre de la empresa */}
                                <div className="flex flex-col justify-center">
                                    <h1 className="text-3xl font-bold text-black sm:text-4xl lg:text-5xl dark:text-white">{company?.name_company}</h1>
                                    <p className="text-ms mt-1 text-black dark:text-white">NIT {company?.nit_company}</p>
                                    <p className="text-xs text-gray-400">{company?.acronym_company}</p>
                                </div>

                                {/* Status y Plans */}
                                <div className="flex flex-col items-start justify-center lg:items-end">
                                    <div className="text-right">
                                        <p className={`text-ms font-bold ${company?.status_company == '1' ? 'text-green-500' : 'text-red-500'}`}>
                                            {company?.status_company == '1' ? 'Activo' : 'Inactivo'}
                                        </p>
                                        <p
                                            className={`text-ms font-bold ${planColors[company?.plans_company as keyof typeof planColors] || 'text-gray-400'}`}
                                        >
                                            {company?.plans_company in plans ? `Plan ${plans[company?.plans_company as keyof typeof plans]}` : ''}
                                        </p>

                                        {/* <p className="text-xs text-gray-400">Vencimiento periodo de prueba</p> */}
                                        {/* <p className="text-xs text-red-700">{dayjs(company?.trial_ends_at).format('dddd, D [de] MMMM [de] YYYY')}</p> */}
                                    </div>
                                </div>

                                {/* Logo de la empresa */}
                                {/* <div className="flex h-24 w-24 items-center justify-center rounded-full border-2 border-white bg-white text-center text-xs text-black">
                                    Logo de la empresa
                                </div> */}
                                <ImagePreview
                                    src={company?.company_logo_url} // <--- Pon aquí company.logo_url
                                    alt="Logo Empresa"
                                    label="Logo"
                                />

                                {/* Fecha de suscripción */}
                                <div className="col-span-full flex justify-end lg:col-span-2 lg:col-start-3">
                                    <div className="text-right">
                                        <p className="text-xs text-gray-400">Fecha de suscripción</p>
                                        <p className="text-xs font-bold text-green-500">
                                            {dayjs(company?.subscription_start_at).format('dddd, D [de] MMMM [de] YYYY')}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {/* Sección de inputs - Fila 1 */}
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <div>
                                    <Label htmlFor="eslogan" className="text-gray-500">
                                        Eslogan de la empresa
                                    </Label>
                                    <Input
                                        placeholder="eslogan"
                                        // value={data.acronym_company}
                                        value="ESLOGAN DE LA EMPRESA"
                                        onChange={(e) => setData('acronym_company', e.target.value)}
                                        className="border-2"
                                    />
                                </div>
                            </div>

                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <div className="lg:col-span-1">
                                    <div className="mb-4">
                                        <Label className="text-gray-500">Código de la actividad económica</Label>
                                        <Combobox
                                            items={economicActivities}
                                            value={data.economic_activity_code ? String(data.economic_activity_code) : ''}
                                            onChange={handleEconomicActivityChange}
                                            placeholder="Selecciona la actividad..."
                                            searchPlaceholder="Buscar por código o nombre..."
                                            // Configuración específica para Inertia
                                            searchParam="search_activity"
                                            currentSearch={filters.search_activity}
                                            dataToReload={['economicActivities']}
                                        />
                                        {errors.economic_activity_code && <p className="text-xs text-red-600">{errors.economic_activity_code}</p>}
                                    </div>
                                </div>
                                <div className="lg:col-span-1">
                                    <Label htmlFor="address_company" className="text-gray-500">
                                        dirección de la empresa
                                    </Label>
                                    <Input
                                        placeholder="address_company"
                                        value={data.address_company}
                                        onChange={(e) => setData('address_company', e.target.value)}
                                        className="border-2"
                                    />
                                </div>
                                <div className="grid grid-cols-2 gap-1">
                                    <div className="mb-4">
                                        <Label htmlFor="legal_representative_identification" className="text-gray-500">
                                            Tipo de Identificación
                                        </Label>

                                        <Combobox
                                            items={identifications}
                                            value={data.legal_representative_identification ? String(data.legal_representative_identification) : ''}
                                            onChange={handleIdentificationChange}
                                            placeholder="Selecciona el tipo de documento..."
                                            searchPlaceholder="Buscar documento..."
                                            // Nota: Al NO pasar 'searchParam', el componente filtra solo en el cliente (memoria),
                                            // lo cual es perfecto y rapidísimo para solo 9 items.
                                        />

                                        {errors.legal_representative_identification && (
                                            <p className="mt-1 text-xs text-red-600">{errors.legal_representative_identification}</p>
                                        )}
                                    </div>
                                    <div>
                                        <Label htmlFor="legal_representative_document" className="text-gray-500">
                                            # identificación del representante legal
                                        </Label>
                                        <Input
                                            placeholder="legal_representative_document"
                                            value={data.legal_representative_document}
                                            onChange={(e) => setData('legal_representative_document', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                            </div>

                            {/* Sección de inputs - Fila 2 */}
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="legal_nature" className="text-gray-500">
                                            naturaleza jurídica de la empresa
                                        </Label>
                                        <Input
                                            placeholder="legal_nature"
                                            value={data.legal_nature}
                                            onChange={(e) => setData('legal_nature', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="phone_company" className="text-gray-500">
                                            Número de teléfono de la empresa
                                        </Label>
                                        <Input
                                            placeholder="phone_company"
                                            value={data.phone_company}
                                            onChange={(e) => setData('phone_company', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="country_company" className="text-gray-500">
                                            país de ubicación de la empresa
                                        </Label>
                                        <Input
                                            placeholder="country_company"
                                            value={data.country_company}
                                            onChange={(e) => setData('country_company', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="province_company" className="text-gray-500">
                                            provincia de ubicación de la empresa
                                        </Label>
                                        <Combobox
                                            items={provinces}
                                            value={data.province_company ? String(data.province_company) : ''}
                                            onChange={handleProvinceChange}
                                            placeholder="Selecciona la provincia..."
                                            searchPlaceholder="Buscar provincia..."
                                            // Nota: Al NO pasar 'searchParam', el componente filtra solo en el cliente (memoria),
                                            // lo cual es perfecto y rapidísimo para solo 9 items.
                                        />
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="legal_representative" className="text-gray-500">
                                            nombre del representante legal
                                        </Label>
                                        <Input
                                            placeholder="legal_representative"
                                            value={data.legal_representative}
                                            onChange={(e) => setData('legal_representative', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="legal_representative_expedition_identificationcard" className="text-gray-500">
                                            expedición del documento de identidad
                                        </Label>
                                        <Input
                                            placeholder="legal_representative_expedition_identificationcard"
                                            value={data.legal_representative_expedition_identificationcard}
                                            onChange={(e) => setData('legal_representative_expedition_identificationcard', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                            </div>

                            {/* Sección de inputs - Fila 3 */}
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="number_employees" className="text-gray-500">
                                            Número de empleados
                                        </Label>
                                        <Input
                                            placeholder="number_employees"
                                            type="number"
                                            value={data.number_employees}
                                            onChange={(e) => setData('number_employees', parseInt(e.target.value) || 0)}
                                            className="border-2"
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="number_branches" className="text-gray-500">
                                            Número de sucursales
                                        </Label>
                                        <Input
                                            placeholder="number_branches"
                                            type="number"
                                            value={data.number_branches}
                                            onChange={(e) => setData('number_branches', parseInt(e.target.value) || 0)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="city_company" className="text-gray-500">
                                            Ciudad donde esta ubicada la empresa
                                        </Label>
                                        <Combobox
                                            items={cities}
                                            value={data.city_company ? String(data.city_company) : ''}
                                            onChange={handleCityChange}
                                            placeholder="Selecciona la ciudad..."
                                            searchPlaceholder="Buscar ciudad..."
                                            // Nota: Al NO pasar 'searchParam', el componente filtra solo en el cliente (memoria),
                                            // lo cual es perfecto y rapidísimo para solo 9 items.
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="email_company" className="text-gray-500">
                                            Email de la empresa
                                        </Label>
                                        <Input
                                            placeholder="email_company"
                                            value={data.email_company}
                                            onChange={(e) => setData('email_company', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                                <div className="lg:col-span-1">
                                    <Label htmlFor="address_representative_legal" className="text-gray-500">
                                        Dirección del representante legal
                                    </Label>
                                    <Input
                                        placeholder="address_representative_legal"
                                        value={data.address_representative_legal}
                                        onChange={(e) => setData('address_representative_legal', e.target.value)}
                                        className="border-2"
                                    />
                                </div>
                            </div>

                            {/* Sección de inputs - Fila 4 */}
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        {/* <Label htmlFor="number_employees">Número de empleados</Label> */}
                                        <Input placeholder="" type="text" value="" className="border-0" readOnly />
                                    </div>
                                    <div>
                                        {/* <Label htmlFor="number_branches">Número de sucursales</Label> */}
                                        <Input placeholder="" type="text" value="" className="border-0" readOnly />
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="website_company" className="text-gray-500">
                                            Sitio web de la empresa
                                        </Label>
                                        <Input
                                            placeholder="province_company"
                                            value={data.website_company}
                                            onChange={(e) => setData('website_company', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="postal_code_company" className="text-gray-500">
                                            Código postal de la empresa
                                        </Label>
                                        <Input
                                            placeholder="postal_code_company"
                                            value={data.postal_code_company}
                                            onChange={(e) => setData('postal_code_company', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 gap-1">
                                    <div>
                                        <Label htmlFor="phone_representative_legal" className="text-gray-500">
                                            Teléfono del representante legal
                                        </Label>
                                        <Input
                                            placeholder="phone_representative_legal"
                                            value={data.phone_representative_legal}
                                            onChange={(e) => setData('phone_representative_legal', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                    <div>
                                        <Label htmlFor="email_representative_legal" className="text-gray-500">
                                            Email del representante legal
                                        </Label>
                                        <Input
                                            placeholder="email_representative_legal"
                                            value={data.email_representative_legal}
                                            onChange={(e) => setData('email_representative_legal', e.target.value)}
                                            className="border-2"
                                        />
                                    </div>
                                </div>
                            </div>

                            {/* Textareas grandes */}
                            <div className="grid grid-cols-1 gap-4 lg:grid-cols-3">
                                <div>
                                    <Label htmlFor="mission_company" className="text-gray-500">
                                        Misión
                                    </Label>
                                    <Textarea
                                        placeholder="mission_company"
                                        value={data.mission_company}
                                        onChange={(e) => setData('mission_company', e.target.value)}
                                        className="h-32 resize-none border-2"
                                    />
                                </div>
                                <div>
                                    <Label htmlFor="vision_company" className="text-gray-500">
                                        Visión
                                    </Label>
                                    <Textarea
                                        placeholder="vision_company"
                                        value={data.vision_company}
                                        onChange={(e) => setData('vision_company', e.target.value)}
                                        className="h-32 resize-none border-2"
                                    />
                                </div>
                                <div>
                                    <Label htmlFor="values_company" className="text-gray-500">
                                        Valores
                                    </Label>
                                    <Textarea
                                        placeholder="values_company"
                                        value={data.values_company}
                                        onChange={(e) => setData('values_company', e.target.value)}
                                        className="h-32 resize-none border-2"
                                    />
                                </div>
                            </div>

                            {/* Scope y Description */}
                            <div className="grid grid-cols-1 gap-4 lg:grid-cols-2">
                                <div>
                                    <Label htmlFor="scope_company" className="text-gray-500">
                                        Alcance
                                    </Label>
                                    <Textarea
                                        placeholder="scope_company"
                                        value={data.scope_company}
                                        onChange={(e) => setData('scope_company', e.target.value)}
                                        className="h-24 resize-none border-2"
                                    />
                                </div>
                                <div>
                                    <Label htmlFor="description_company" className="text-gray-500">
                                        Descripción
                                    </Label>
                                    <Textarea
                                        placeholder="description_company"
                                        value={data.description_company}
                                        onChange={(e) => setData('description_company', e.target.value)}
                                        className="h-24 resize-none border-2"
                                    />
                                </div>
                            </div>

                            {/* Sección de imágenes/documentos */}
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                                <ImagePreview
                                    src={null} // Aquí iría: company.organogram_url
                                    alt="Organigrama"
                                    label="Imagen del Organigrama"
                                    className="h-32 w-full" // <--- ESTO MANTIENE EL DISEÑO ORIGINAL
                                />
                                <div className="flex h-32 items-center justify-center rounded-lg border-2">Políticas claves en PDF</div>
                                <div className="flex h-32 items-center justify-center rounded-lg border-2">Reglamento Interno en PDF</div>
                                <div className="flex h-32 items-center justify-center rounded-lg border-2">Manual de Funciones en PDF</div>
                                <div className="flex h-32 items-center justify-center rounded-lg border-2">Imagen del Aquí va un nuevo contenido</div>
                            </div>
                        </div>
                    </div>

                    <div className="z-10 flex-none border-t border-gray-200 bg-white p-4 shadow-[0_-5px_10px_rgba(0,0,0,0.05)] dark:border-gray-700 dark:bg-[#1a1a1a]">
                        <div className="flex items-center justify-between">
                            {/* Puedes poner un mensaje a la izquierda si quieres, o dejarlo vacío */}
                            <span className={`hidden text-lg sm:block ${isDirty ? 'text-red-500' : 'text-green-500'}`}>
                                {isDirty ? 'Tienes cambios sin guardar' : 'Información al día'}
                            </span>

                            <Button
                                type="submit"
                                disabled={processing || !isDirty}
                                className="min-w-[120px] bg-green-600 text-white hover:bg-green-700"
                            >
                                {processing ? 'Actualizando...' : 'ACTUALIZAR'}
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
