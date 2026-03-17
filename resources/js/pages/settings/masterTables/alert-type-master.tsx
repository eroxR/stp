import MasterViewLayout from '@/components/master-view-layout';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { MySwal } from '@/lib/swal';
import { Head, useForm } from '@inertiajs/react';
import { AlertTriangle, Bell, Edit, Eye, EyeOff, Info, PlusCircle, Save, ShieldAlert, Trash2, X } from 'lucide-react'; // Iconos extra
import { useState } from 'react';
import { toast } from 'sonner';
import { CustomTooltip } from '@/components/ui/custom-tooltip';

// Tipos adaptados a la tabla alert_types
interface AlertType {
    id: number;
    name: string;
    description: string | null;
    severity_level: string; // '1', '2', '3'
    icon: string | null;
    visibility: string;
    company_view: number[] | string[] | null;
}

interface FormData {
    name: string;
    description: string;
    severity_level: string;
    icon: string;
    visibility: string;
}

interface Props {
    data: AlertType[] | any;
}

export default function AlertTypeMaster({ data }: Props) {
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
        name: '',
        description: '',
        severity_level: '1', // Default Info
        icon: '',
        visibility: '1',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingId) {
            put(`/settings/masterTables/alert-types/${editingId}`, {
                onSuccess: () => {
                    handleCancel();
                    toast.success('Tipo de alerta actualizado');
                },
                onError: () => toast.error('Error al actualizar'),
            });
        } else {
            post('/settings/masterTables/alert-types', {
                onSuccess: () => {
                    reset();
                    toast.success('Tipo de alerta creado');
                },
                onError: () => toast.error('Error al crear'),
            });
        }
    };

    const handleEdit = (item: AlertType) => {
        setEditingId(item.id);
        setData({
            name: item.name,
            description: item.description || '',
            severity_level: item.severity_level,
            icon: item.icon || '',
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
            text: 'El tipo de alerta se eliminará permanentemente.',
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
                destroy(`/settings/masterTables/alert-types/${id}`, {
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

    // Helper para el color del badge según severidad
    const getSeverityBadge = (level: string) => {
        switch (level) {
            case '1':
                return (
                    <Badge className="bg-blue-500 hover:bg-blue-600">
                        <Info className="mr-1 h-3 w-3" /> Info
                    </Badge>
                );
            case '2':
                return (
                    <Badge className="bg-amber-500 hover:bg-amber-600">
                        <AlertTriangle className="mr-1 h-3 w-3" /> Advertencia
                    </Badge>
                );
            case '3':
                return (
                    <Badge className="bg-red-500 hover:bg-red-600">
                        <ShieldAlert className="mr-1 h-3 w-3" /> Peligro
                    </Badge>
                );
            default:
                return <Badge variant="secondary">Desconocido</Badge>;
        }
    };

    // --- RENDERIZADORES ---

    // 1. Diseño para GRID (Pocos datos) - Tipo tarjeta visual
    const renderCard = (item: AlertType) => (
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
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Nombre Alerta:</span>
                        <div className="mb-2 flex items-start justify-between">{getSeverityBadge(item.severity_level)}</div>
                    </div>
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Severidad:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.severity_level}</span>
                    </div>
                </div>
                <div className="mt-2 flex flex-wrap items-center gap-2">
                    <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Descripción:</span>
                    <p className="mt-1 text-sm font-medium break-words text-slate-700 dark:text-slate-200">{item.description || 'Sin descripción'}</p>
                </div>
                <div className="mt-2">
                    <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Color de Severidad:</span>
                    <p className="mt-1 text-sm font-medium break-words text-slate-700 dark:text-slate-200">{item.icon || 'Sin icono'}</p>
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
    const renderRow = (item: AlertType) => (
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
                    <span className="text-sm font-medium text-blue-500">Color de Severidad:</span>
                    <Badge variant="outline" className="bg-background">
                        {getSeverityBadge(item.severity_level)}
                    </Badge>
                    <span className="text-sm font-medium text-blue-500">Severidad:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.severity_level}</span>
                    <span className="text-sm font-medium text-blue-500">Color de Severidad:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.icon}</span>
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
            <Head title="Tipos de Alertas" />

            {/* SECCIÓN FIJA: FORMULARIO */}
            <div className="flex-none space-y-6">
                <div>
                    <h2 className="text-2xl font-bold tracking-tight">Maestra de Tipos de Alertas</h2>
                    <p className="text-sm text-muted-foreground">Configura las alertas del sistema y sus niveles de severidad.</p>
                </div>

                <Card className="border-l-4 border-l-blue-600 bg-muted/20 shadow-sm dark:bg-muted/10">
                    <CardContent className="pt-6">
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            {/* Fila 1 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="name">Nombre Alerta</Label>
                                    <Input
                                        id="name"
                                        placeholder="Ej: Mantenimiento Preventivo"
                                        value={formData.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        disabled={processing}
                                    />
                                    {errors.name && <span className="text-xs text-red-500">{errors.name}</span>}
                                </div>

                                <div className="grid w-full gap-1.5 md:w-1/3">
                                    <Label htmlFor="severity">Severidad</Label>
                                    <Select
                                        value={formData.severity_level}
                                        onValueChange={(val) => setData('severity_level', val)}
                                        disabled={processing}
                                    >
                                        <SelectTrigger id="severity">
                                            <SelectValue placeholder="Seleccione nivel" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="1">Nivel 1 - Informativa</SelectItem>
                                            <SelectItem value="2">Nivel 2 - Advertencia</SelectItem>
                                            <SelectItem value="3">Nivel 3 - Peligro</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    {errors.severity_level && <span className="text-xs text-red-500">{errors.severity_level}</span>}
                                </div>
                            </div>

                            {/* Fila 2 */}
                            <div className="flex flex-col gap-4 md:flex-row">
                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="description">Descripción</Label>
                                    <textarea
                                        id="description"
                                        placeholder="Detalles sobre esta alerta..."
                                        value={formData.description}
                                        onChange={(e) => setData('description', e.target.value)}
                                        disabled={processing}
                                        maxLength={255}
                                        className="w-full rounded-md border border-input px-3 py-2 text-sm shadow-sm focus:ring-2 focus:ring-primary/40 focus:outline-none"
                                    />
                                </div>

                                <div className="grid w-full gap-1.5 md:w-48">
                                    <Label htmlFor="icon">Color Alerta</Label>
                                    <Input
                                        id="icon"
                                        placeholder="Ej: lucide-alert"
                                        value={formData.icon}
                                        onChange={(e) => setData('icon', e.target.value)}
                                        disabled={processing}
                                    />
                                </div>
                            </div>

                            <div className="flex justify-end gap-2 pt-2">
                                {editingId && (
                                    <Button type="button" variant="outline" onClick={handleCancel}>
                                        <X className="mr-2 h-4 w-4" /> Cancelar
                                    </Button>
                                )}
                                <Button type="submit" disabled={processing} className={editingId ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700 dark:text-white'}>
                                    {editingId ? <Save className="mr-2 h-4 w-4" /> : <PlusCircle className="mr-2 h-4 w-4" />}
                                    {editingId ? 'Actualizar Alerta' : 'Crear Alerta'}
                                </Button>
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
