import {
    Dialog,
    DialogContent, // <--- 1. Importar esto
    DialogDescription, // <--- 2. Importar esto
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { cn } from '@/lib/utils';
import { ImagePlus, Pencil } from 'lucide-react';
import { useEffect, useRef, useState } from 'react';

interface ImagePreviewProps {
    src?: string | null;
    alt: string;
    label: string;
    className?: string;
    onImageSelect?: (file: File) => void;
}

export function ImagePreview({ src, alt, label, className, onImageSelect }: ImagePreviewProps) {
    const [preview, setPreview] = useState<string | null>(src || null);
    const fileInputRef = useRef<HTMLInputElement>(null);

    useEffect(() => {
        setPreview(src || null);
    }, [src]);

    const handleTriggerFileInput = (e: React.MouseEvent) => {
        e.stopPropagation();
        e.preventDefault();
        fileInputRef.current?.click();
    };

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            const objectUrl = URL.createObjectURL(file);
            setPreview(objectUrl);
            if (onImageSelect) {
                onImageSelect(file);
            }
        }
    };

    return (
        <>
            <input type="file" ref={fileInputRef} className="hidden" accept="image/*" onChange={handleFileChange} />

            <Dialog>
                <div
                    className={cn(
                        'group relative flex h-24 w-32 items-center justify-center overflow-hidden rounded-lg border-2 text-center text-xs shadow-sm transition-all',
                        'hover:scale-105 hover:shadow-md',
                        'border-gray-200 bg-white text-gray-500 hover:border-blue-500',
                        'dark:border-gray-700 dark:bg-transparent dark:text-gray-100 dark:hover:border-blue-400',
                        className,
                    )}
                >
                    <button
                        type="button"
                        onClick={handleTriggerFileInput}
                        className={cn(
                            'absolute top-1 right-1 z-10 hidden rounded-full p-1.5 shadow-sm transition-all group-hover:flex',
                            'bg-white text-gray-700 hover:bg-blue-50 hover:text-blue-600',
                            'dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-blue-400',
                        )}
                        title="Cambiar imagen"
                    >
                        {preview ? <Pencil className="h-3 w-3" /> : <ImagePlus className="h-3 w-3" />}
                    </button>

                    <DialogTrigger asChild>
                        <button type="button" className="flex h-full w-full items-center justify-center focus:outline-none">
                            {preview ? (
                                <img src={preview} alt={alt} className="h-full w-full object-cover" />
                            ) : (
                                <span className="px-2 font-medium select-none">{label}</span>
                            )}
                        </button>
                    </DialogTrigger>
                </div>

                <DialogContent className="max-w-4xl border-0 bg-transparent p-0 shadow-none outline-none">
                    {/* --- SOLUCIÓN DE ERRORES DE ACCESIBILIDAD --- */}
                    {/* Estos elementos están ahí para el navegador, pero ocultos al ojo humano */}
                    <DialogTitle className="sr-only">Vista previa: {label}</DialogTitle>
                    <DialogDescription className="sr-only">Imagen ampliada o formulario de carga para {alt || label}</DialogDescription>
                    {/* ------------------------------------------- */}

                    <div className="relative flex items-center justify-center overflow-hidden rounded-lg">
                        {preview ? (
                            <img src={preview} alt={alt} className="max-h-[80vh] w-auto max-w-full rounded-md object-contain shadow-2xl" />
                        ) : (
                            <div className="flex h-64 w-96 flex-col items-center justify-center gap-4 rounded-md bg-white p-8 shadow-xl dark:border dark:border-gray-700 dark:bg-[#1a1a1a]">
                                <p className="text-lg text-gray-500 dark:text-gray-300">No hay imagen seleccionada.</p>
                                <button
                                    onClick={(e) => handleTriggerFileInput(e)}
                                    className="flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700"
                                >
                                    <ImagePlus className="h-4 w-4" />
                                    Subir imagen
                                </button>
                            </div>
                        )}
                    </div>
                </DialogContent>
            </Dialog>
        </>
    );
}
