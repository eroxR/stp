import MasterViewLayout from '@/components/master-view-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { CustomTooltip } from '@/components/ui/custom-tooltip';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { MySwal } from '@/lib/swal';
import { Head, useForm } from '@inertiajs/react';
import { CreditCard, Edit, Eye, EyeOff, PlusCircle, Save, Trash2, X } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';

// Interfaces
interface SupplierCategory {
    id: number;
    // Ajusta el nombre del campo según tu tabla supplier_categories (ej: name, description)
    description_categorysupplier?: string;
    name?: string;
}

interface ProductAndService {
    id: number;
    // En algunos casos Laravel devuelve la relación directamente en el campo FK.
    // Por eso permitimos que sea número o el objeto completo.
    supplier_category: number | null | SupplierCategory;
    productandservice_description: string;
    visibility: string;
    company_view: number[] | string[] | null;
    supplier_category_rel?: SupplierCategory; // Laravel carga la relación como supplier_category o supplierCategory (camelCase)
    supplierCategory?: SupplierCategory; // Manejamos ambos por si acaso
}

interface FormData {
    supplier_category: string;
    productandservice_description: string;
    visibility: string;
}

interface Props {
    data: ProductAndService[] | any;
    supplierCategoriesSelect: SupplierCategory[];
}

export default function ProductServiceMaster({ data, supplierCategoriesSelect }: Props) {
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
        supplier_category: '',
        productandservice_description: '',
        visibility: '1',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingId) {
            put(`/settings/masterTables/products-and-services/${editingId}`, {
                onSuccess: () => {
                    handleCancel();
                    toast.success('Producto/Servicio actualizado');
                },
                onError: () => toast.error('Error al actualizar'),
            });
        } else {
            post('/settings/masterTables/products-and-services', {
                onSuccess: () => {
                    reset();
                    toast.success('Producto/Servicio creado');
                },
                onError: () => toast.error('Error al crear'),
            });
        }
    };

    const handleEdit = (item: ProductAndService) => {
        setEditingId(item.id);
        setData({
            supplier_category: item.supplier_category ? item.supplier_category.toString() : '',
            productandservice_description: item.productandservice_description,
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
            text: 'El registro se eliminará permanentemente.',
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
                destroy(`/settings/masterTables/products-and-services/${id}`, {
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

    // Helper para obtener el nombre de la categoría de forma segura.
    // Solo debe usar la relación que venga del backend (sin hacer búsquedas adicionales).
    const getCategoryName = (item: ProductAndService) => {
        const cat =
            (item.supplierCategory as SupplierCategory) ||
            (item.supplier_category_rel as SupplierCategory) ||
            (item.supplier_category as SupplierCategory);

        return cat?.description_categorysupplier || 'Sin categoría';
    };

    // Helper para nombre de categoría en el select
    // Ya no se usa, se cambió a directo

    // --- RENDERIZADORES ---

    // 1. Diseño para GRID (Pocos datos) - Tipo tarjeta visual
    const renderCard = (item: ProductAndService) => (
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
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Categoría:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{getCategoryName(item)}</span>
                    </div>
                </div>
                <div className="w-full">
                    <div className="flex flex-wrap items-start gap-2">
                        <span className="text-xs font-semibold tracking-wide text-blue-500 uppercase">Descripción Productos o Servicios:</span>
                        <span className="text-sm font-medium text-slate-700 dark:text-slate-200">{item.productandservice_description}</span>
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
    const renderRow = (item: ProductAndService) => (
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
                    <CreditCard className="h-4 w-4 text-blue-600 dark:text-blue-400" />
                </div>

                <div className="flex flex-wrap items-center gap-2">
                    <span className="text-sm font-medium text-blue-500">Categoría:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{getCategoryName(item)}</span>
                    <span className="text-sm font-medium text-blue-500">Descripción Productos o Servicios:</span>
                    <span className="text-sm font-bold text-slate-900 dark:text-slate-100">{item.productandservice_description}</span>
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
            <Head title="Productos y Servicios" />

            {/* SECCIÓN FIJA: FORMULARIO */}
            <div className="flex-none space-y-6">
                <div>
                    <h2 className="text-2xl font-bold tracking-tight">Maestra de Productos y Servicios</h2>
                    <p className="text-sm text-muted-foreground">Administra el catálogo de bienes y servicios ofrecidos o requeridos.</p>
                </div>

                <Card className="border-l-4 border-l-blue-600 bg-muted/20 shadow-sm dark:bg-muted/10">
                    <CardContent className="pt-6">
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            <div className="flex flex-col gap-4 md:flex-row">
                                {/* Campo Descripción */}
                                <div className="grid w-full flex-1 gap-1.5">
                                    <Label htmlFor="desc">Descripción Producto/Servicio</Label>
                                    <Input
                                        id="desc"
                                        placeholder="Ej: Mantenimiento de Frenos, Papelería"
                                        value={formData.productandservice_description}
                                        onChange={(e) => setData('productandservice_description', e.target.value)}
                                        disabled={processing}
                                        maxLength={120}
                                    />
                                    {errors.productandservice_description && (
                                        <span className="text-xs text-red-500">{errors.productandservice_description}</span>
                                    )}
                                </div>

                                {/* Campo Categoría */}
                                <div className="grid w-full gap-1.5 md:flex-1">
                                    <Label htmlFor="cat">Categoría de Proveedor</Label>
                                    <Select
                                        value={formData.supplier_category}
                                        onValueChange={(val) => setData('supplier_category', val)}
                                        disabled={processing}
                                    >
                                        <SelectTrigger id="cat">
                                            <SelectValue placeholder="Seleccione Categoría" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {supplierCategoriesSelect.length > 0 ? (
                                                supplierCategoriesSelect.map((cat) => (
                                                    <SelectItem key={cat.id} value={cat.id.toString()}>
                                                        {cat.description_categorysupplier}
                                                    </SelectItem>
                                                ))
                                            ) : (
                                                <SelectItem value="disabled" disabled>
                                                    No hay categorías
                                                </SelectItem>
                                            )}
                                        </SelectContent>
                                    </Select>
                                    {errors.supplier_category && <span className="text-xs text-red-500">{errors.supplier_category}</span>}
                                </div>

                                {/* Botones */}
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
