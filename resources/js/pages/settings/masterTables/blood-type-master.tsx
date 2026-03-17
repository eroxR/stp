import MasterViewLayout from '@/components/master-view-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { MySwal } from '@/lib/swal'; // Usamos MySwal para eliminar
import { Head, useForm } from '@inertiajs/react';
import { Activity, Edit, Eye, EyeOff, PlusCircle, Save, Trash2, X } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner'; // Usamos Sonner
import { CustomTooltip } from '@/components/ui/custom-tooltip';

// Tipos adaptados a la tabla blood_types
interface BloodType {
    id: number;
    blood_type_description: string; // <--- Campo específico
    visibility: string;
    company_view: number[] | string[] | null;
}

interface FormData {
    blood_type_description: string;
    visibility: string;
}

interface Props {
    data: BloodType[] | any;
}

export default function BloodTypeMaster({ data }: Props) {
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
        blood_type_description: '',
        visibility: '1',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingId) {
            put(`/settings/masterTables/blood-types/${editingId}`, {
                onSuccess: () => {
                    handleCancel();
                    toast.success('Tipo de sangre actualizado correctamente');
                },
                onError: () => toast.error('Error al actualizar el registro'),
            });
        } else {
            post('/settings/masterTables/blood-types', {
                onSuccess: () => {
                    reset();
                    toast.success('Tipo de sangre creado correctamente');
                },
                onError: () => toast.error('Error al crear el registro'),
            });
        }
    };

    const handleEdit = (item: BloodType) => {
        setEditingId(item.id);
        setData({
            blood_type_description: item.blood_type_description,
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
            text: 'El tipo de sangre se eliminará permanentemente.',
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
                destroy(`/settings/masterTables/blood-types/${id}`, {
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
    const renderCard = (item: BloodType) => (
        <Card
            key={item.id}
            className={`flex flex-col justify-between transition-all hover:shadow-md ${
                editingId === item.id
                    ? 'border border-amber-500 bg-muted/50 shadow-lg ring-amber-500 ring-offset-2 ring-offset-background dark:bg-amber-950/20'
                    : 'border-border'
            }`}
        >
            <CardHeader className="pb-2">
                <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Descripción Tipo de Sangre:</span>
                <CardTitle className="text-base leading-tight font-bold" title={item.blood_type_description}>
                    {item.blood_type_description}
                </CardTitle>
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
    const renderRow = (item: BloodType) => (
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
                    <Activity className="h-4 w-4 text-blue-600 dark:text-blue-400" />
                </div>

                <div className="flex flex-wrap items-center gap-2">
                    <span className="text-sm font-medium text-blue-500">Descripción Tipo de Sangre:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.blood_type_description}</span>
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
            <Head title="Tipos de Sangre" />

            {/* SECCIÓN FIJA */}
            <div className="flex-none space-y-6">
                <div>
                    <h2 className="text-2xl font-bold tracking-tight">Maestra de Tipos de Sangre</h2>
                    <p className="text-sm text-muted-foreground">Administra los tipos de sangre (RH) válidos en el sistema.</p>
                </div>

                <Card className="border-l-4 border-l-blue-600 bg-muted/20 shadow-sm dark:bg-muted/10">
                    <CardContent className="pt-6">
                        <form onSubmit={handleSubmit} className="flex flex-col items-end gap-4 md:flex-row">
                            <div className="grid w-full flex-1 gap-1.5">
                                <Label htmlFor="desc">Descripción Tipo de Sangre</Label>
                                <Input
                                    id="desc"
                                    placeholder="Ej: O+, A-, AB+"
                                    value={formData.blood_type_description}
                                    onChange={(e) => setData('blood_type_description', e.target.value)}
                                    disabled={processing}
                                />
                                {errors.blood_type_description && <span className="text-xs text-red-500">{errors.blood_type_description}</span>}
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

                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing} className={editingId ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700 dark:text-white'}>
                                    {editingId ? <Save className="mr-2 h-4 w-4" /> : <PlusCircle className="mr-2 h-4 w-4" />}
                                    {editingId ? 'Actualizar' : 'Crear'}
                                </Button>

                                {editingId && (
                                    <Button type="button" variant="outline" onClick={handleCancel}>
                                        <X className="h-4 w-4" />
                                    </Button>
                                )}
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
