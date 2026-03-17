import MasterViewLayout from '@/components/master-view-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { MySwal } from '@/lib/swal';
import { Head, useForm } from '@inertiajs/react';
import { Edit, Eye, EyeOff, NotebookTabs, PlusCircle, Save, Trash2, X } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';
import { CustomTooltip } from '@/components/ui/custom-tooltip';

interface ContractType {
    id: number;
    contract_name: string;
    description_typecontract: string | null;
    start_contract: number | null;
    contract_limit: number | null;
    visibility: string;
    company_view: number[] | string[] | null;
    code_company: string | null;
}

interface FormData {
    contract_name: string;
    description_typecontract: string;
    start_contract: string | number;
    contract_limit: string | number;
    visibility: string;
    code_company: string | null;
}

interface Props {
    data: ContractType[] | any;
}

export default function ContractTypeMaster({ data }: Props) {
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
        contract_name: '',
        description_typecontract: '',
        start_contract: '',
        contract_limit: '',
        visibility: '1',
        code_company: null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingId) {
            put(`/settings/masterTables/contract-types/${editingId}`, {
                onSuccess: () => {
                    handleCancel();
                    toast.success('Tipo de contrato actualizado');
                },
                onError: () => toast.error('Error al actualizar'),
            });
        } else {
            post('/settings/masterTables/contract-types', {
                onSuccess: () => {
                    reset();
                    toast.success('Tipo de contrato creado');
                },
                onError: () => toast.error('Error al crear'),
            });
        }
    };

    const handleEdit = (item: ContractType) => {
        setEditingId(item.id);
        setData({
            contract_name: item.contract_name,
            description_typecontract: item.description_typecontract || '',
            start_contract: item.start_contract || '',
            contract_limit: item.contract_limit || '',
            code_company: item.code_company || null,
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
            text: 'El tipo de contrato se eliminará permanentemente.',
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
                destroy(`/settings/masterTables/contract-types/${id}`, {
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
    const renderCard = (item: ContractType) => (
        <Card
            key={item.id}
            className={`flex flex-col justify-between transition-all hover:shadow-md ${
                editingId === item.id ? 'border border-amber-500 bg-muted/50 shadow-lg ring-amber-500 ring-offset-2 ring-offset-background' : ''
            }`}
        >
            <CardHeader className="pb-2">
                <div className="w-full">
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Nombre del Contrato:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.contract_name}</span>
                    </div>
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Compañia:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.code_company}</span>
                    </div>
                </div>
                <div className="w-full">
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Inicio Numeración:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.start_contract}</span>
                    </div>

                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Limite de Numeración:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.contract_limit}</span>
                    </div>
                </div>
                <div className="mt-2">
                    <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Descripción:</span>
                    <p className="mt-1 text-sm font-medium break-words text-slate-700 dark:text-slate-200">
                        {item.description_typecontract || 'Sin descripción'}
                    </p>
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
    const renderRow = (item: ContractType) => (
        <div
            key={item.id}
            className={`group flex items-center justify-between rounded-md border bg-card p-3 transition-colors hover:bg-accent/50 ${
                editingId === item.id ? 'border-amber-500 bg-amber-50 dark:bg-amber-950/20' : 'border-border'
            }`}
        >
            {/* Información Izquierda */}
            <div className="flex items-center gap-4 overflow-hidden">
                <div className="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                    {/* Icono representativo */}
                    <NotebookTabs className="h-4 w-4 text-blue-600 dark:text-blue-400" />
                </div>
                <div className="flex flex-wrap items-center gap-2">
                    <span className="text-sm font-medium text-blue-500">Nombre del Contrato:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.contract_name}</span>
                    <span className="text-sm font-medium text-blue-500">Compañia:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.code_company}</span>
                    <span className="text-sm font-medium text-blue-500">Inicio Numeración:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.start_contract}</span>
                    <span className="text-sm font-medium text-blue-500">Limite de Numeración:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.contract_limit}</span>
                    <span className="text-sm font-medium text-blue-500">Descripción:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.description_typecontract}</span>
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
            <Head title="Tipos de Contrato" />

            {/* SECCIÓN FIJA: FORMULARIO */}
            <div className="flex-none space-y-6">
                <div>
                    <h2 className="text-2xl font-bold tracking-tight">Maestra de Tipos de Contrato</h2>
                    <p className="text-sm text-muted-foreground">Configura los tipos de contratos (ej: FUEC) y sus rangos numéricos.</p>
                </div>

                <Card className="border-l-4 border-l-blue-600 bg-muted/20 shadow-sm dark:bg-muted/10">
                    <CardContent className="pt-6">
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            {/* Fila 1 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="name">Nombre del Contrato</Label>
                                    <Input
                                        id="name"
                                        placeholder="Ej: Contrato Ocasional (FUEC)"
                                        value={formData.contract_name}
                                        onChange={(e) => setData('contract_name', e.target.value)}
                                        disabled={processing}
                                        maxLength={120}
                                    />
                                    {errors.contract_name && <span className="text-xs text-red-500">{errors.contract_name}</span>}
                                </div>

                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="desc">Descripción</Label>
                                    <textarea
                                        id="desc"
                                        placeholder="Detalles adicionales..."
                                        value={formData.description_typecontract}
                                        onChange={(e) => setData('description_typecontract', e.target.value)}
                                        disabled={processing}
                                        maxLength={255}
                                        className="w-full rounded-md border border-input px-3 py-2 text-sm shadow-sm focus:ring-2 focus:ring-primary/40 focus:outline-none"
                                    />
                                </div>
                            </div>

                            {/* Fila 2 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full gap-1.5 md:w-48">
                                    <Label htmlFor="start">Inicio Numeración</Label>
                                    <Input
                                        id="start"
                                        type="number"
                                        placeholder="0"
                                        value={formData.start_contract}
                                        onChange={(e) => setData('start_contract', e.target.value)}
                                        disabled={processing}
                                    />
                                    {errors.start_contract && <span className="text-xs text-red-500">{errors.start_contract}</span>}
                                </div>

                                <div className="grid w-full gap-1.5 md:w-48">
                                    <Label htmlFor="limit">Límite Numeración</Label>
                                    <Input
                                        id="limit"
                                        type="number"
                                        placeholder="999999"
                                        value={formData.contract_limit}
                                        onChange={(e) => setData('contract_limit', e.target.value)}
                                        disabled={processing}
                                    />
                                    {errors.contract_limit && <span className="text-xs text-red-500">{errors.contract_limit}</span>}
                                </div>

                                <div className="flex w-full flex-1 items-end justify-end gap-2 pt-1 md:w-auto">
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
