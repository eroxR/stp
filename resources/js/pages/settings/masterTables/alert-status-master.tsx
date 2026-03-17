import MasterViewLayout from '@/components/master-view-layout';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { CustomTooltip } from '@/components/ui/custom-tooltip';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { MySwal } from '@/lib/swal';
import { Head, useForm } from '@inertiajs/react';
import { Archive, Bell, Edit, Eye, EyeOff, PlusCircle, Save, Trash2, X } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';

interface AlertStatus {
    id: number;
    code: number;
    name: string;
    icon_description: string | null;
    description: string | null;

    company_view: number[] | string[] | null;
}

interface FormData {
    code: string | number;
    name: string;
    icon_description: string;
    description: string;
}

interface Props {
    data: AlertStatus[] | any;
}

export default function AlertStatusMaster({ data }: Props) {
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
        code: '',
        name: '',
        icon_description: '',
        description: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingId) {
            put(`/settings/masterTables/alert-statuses/${editingId}`, {
                onSuccess: () => {
                    handleCancel();
                    toast.success('Estado actualizado correctamente');
                },
                onError: () => toast.error('Error al actualizar'),
            });
        } else {
            post('/settings/masterTables/alert-statuses', {
                onSuccess: () => {
                    reset();
                    toast.success('Estado creado correctamente');
                },
                onError: () => toast.error('Error al crear'),
            });
        }
    };

    const handleEdit = (item: AlertStatus) => {
        setEditingId(item.id);
        setData({
            code: item.code,
            name: item.name,
            icon_description: item.icon_description || '',
            description: item.description || '',
        });
    };

    const handleCancel = () => {
        setEditingId(null);
        reset();
    };

    const iconComponents = {
        Eye,
        Trash2,
        Archive,
        EyeOff,
        Edit,
        PlusCircle,
        Save,
        X,
    } as const;

    const handleDelete = (id: number) => {
        MySwal.fire({
            title: '¿Estás seguro?',
            text: 'El estado de alerta se eliminará permanentemente.',
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
                destroy(`/settings/masterTables/alert-statuses/${id}`, {
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
    const renderCard = (item: AlertStatus) => (
        <Card
            key={item.id}
            className={`flex flex-col justify-between transition-all hover:shadow-md ${
                editingId === item.id
                    ? 'border border-amber-500 bg-muted/50 shadow-lg ring-amber-500 ring-offset-2 ring-offset-background dark:bg-amber-950/20'
                    : 'border-border'
            }`}
        >
            <CardHeader className="">
                <div className="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Código:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.code}</span>
                    </div>
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Nombre:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.name}</span>
                    </div>
                </div>
                <div className="mt-2 flex flex-wrap items-center gap-2">
                    <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Icono:</span>
                    <span className="text-sm font-medium text-slate-700 dark:text-slate-200">
                        {(() => {
                            const key = (item.icon_description || 'Eye').trim();
                            const Icon = iconComponents[key as keyof typeof iconComponents];
                            return Icon ? <Icon className="h-4 w-4 text-green-500" /> : <span>{key}</span>;
                        })()}
                    </span>
                </div>
                <div className="mt-2">
                    <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Descripción:</span>
                    <p className="mt-1 text-sm font-medium break-words text-slate-700 dark:text-slate-200">{item.description || 'Sin descripción'}</p>
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
    const renderRow = (item: AlertStatus) => (
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
                    <Bell className="h-4 w-4 text-blue-600 dark:text-blue-400" />
                </div>

                <div className="flex flex-wrap items-center gap-2">
                    <span className="text-sm font-medium text-blue-500">Icono:</span>
                    {(() => {
                        const key = (item.icon_description || 'Eye').trim();
                        const Icon = iconComponents[key as keyof typeof iconComponents];
                        return Icon ? <Icon className="h-4 w-4 text-green-500" /> : <span>{key}</span>;
                    })()}
                    <span className="text-sm font-medium text-blue-500">Código:</span>
                    <Badge variant="outline" className="bg-background">
                        {item.code}
                    </Badge>
                    <span className="text-sm font-medium text-blue-500">Nombre:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.name}</span>
                    <span className="text-sm font-medium text-blue-500">Descripción:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.description}</span>
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
            <Head title="Estados de Alertas" />

            {/* SECCIÓN FIJA: FORMULARIO */}
            <div className="flex-none space-y-6">
                <div>
                    <h2 className="text-2xl font-bold tracking-tight">Maestra de Estados de Alertas</h2>
                    <p className="text-sm text-muted-foreground">Define los estados posibles de una alerta (ej: Nueva, Resuelta, Cerrada).</p>
                </div>

                <Card className="border-l-4 border-l-blue-600 bg-muted/20 shadow-sm dark:bg-muted/10">
                    <CardContent className="pt-6">
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            {/* Fila 1 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full gap-1.5 md:w-32">
                                    <Label htmlFor="code">Código</Label>
                                    <Input
                                        id="code"
                                        type="number"
                                        placeholder="Ej: 1"
                                        value={formData.code}
                                        onChange={(e) => setData('code', e.target.value)}
                                        disabled={processing}
                                    />
                                    {errors.code && <span className="text-xs text-red-500">{errors.code}</span>}
                                </div>

                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="name">Nombre del Estado</Label>
                                    <Input
                                        id="name"
                                        placeholder="Ej: En Progreso"
                                        value={formData.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        disabled={processing}
                                        maxLength={20}
                                    />
                                    {errors.name && <span className="text-xs text-red-500">{errors.name}</span>}
                                </div>

                                {/* <div className="grid w-full gap-1.5 md:w-48">
                                    <Label htmlFor="vis">Visibilidad</Label>
                                    <Select value={formData.visibility} onValueChange={(val) => setData('visibility', val)} disabled={processing}>
                                        <SelectTrigger id="vis">
                                            <SelectValue placeholder="Estado" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="1">Visible</SelectItem>
                                            <SelectItem value="0">Oculto</SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div> */}
                            </div>

                            {/* Fila 2 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="description">Descripción</Label>
                                    <textarea
                                        id="description"
                                        placeholder="Descripción detallada del estado..."
                                        value={formData.description}
                                        onChange={(e) => setData('description', e.target.value)}
                                        disabled={processing}
                                        maxLength={255}
                                        className="w-full rounded-md border border-input px-3 py-2 text-sm shadow-sm focus:ring-2 focus:ring-primary/40 focus:outline-none"
                                    />
                                </div>

                                <div className="grid w-full gap-1.5 md:w-48">
                                    <Label htmlFor="icon">Icono (Clase)</Label>
                                    <Input
                                        id="icon"
                                        placeholder="Ej: lucide-check"
                                        value={formData.icon_description}
                                        onChange={(e) => setData('icon_description', e.target.value)}
                                        disabled={processing}
                                    />
                                </div>

                                <div className="flex w-full items-end justify-end gap-2 pt-1 md:w-auto">
                                    {editingId && (
                                        <Button type="button" variant="outline" onClick={handleCancel}>
                                            <X className="mr-2 h-4 w-4" />
                                        </Button>
                                    )}
                                    <Button
                                        type="submit"
                                        disabled={processing}
                                        className={editingId ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700 dark:text-white'}
                                    >
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
