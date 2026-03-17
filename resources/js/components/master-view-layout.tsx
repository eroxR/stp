/* eslint-disable @typescript-eslint/no-explicit-any */
import Pagination from '@/components/pagination';
import { ReactNode } from 'react';

// Interfaces auxiliares para la paginación
interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
    links: PaginationLink[];
    [key: string]: any;
}

interface PaginatedData<T> {
    data: T[];
    links: PaginationLink[];
    meta: PaginationMeta;
}

// Props del componente usando Genéricos <T>
interface Props<T> {
    // La data puede ser un Array simple o un Objeto Paginado
    // data: T[] | PaginatedData<T>;
    data: T[] | any;
    // Las funciones de renderizado reciben un item de tipo T
    renderCard: (item: T) => ReactNode;
    renderRow: (item: T) => ReactNode;
}

export default function MasterViewLayout<T extends { id: number }>({ data, renderCard, renderRow }: Props<T>) {
    // 1. Detectar si es paginado o array simple
    const isPaginated = data && typeof data === 'object' && !Array.isArray(data) && 'data' in data;

    // 2. Normalizar los datos
    const items: T[] = isPaginated ? data.data : data || [];
    const total = isPaginated ? (data.meta?.total ?? data.total) : items.length;
    const links = isPaginated ? (data.meta?.links ?? data.links) : undefined;

    // 3. Obtener total
    const metaInfo = isPaginated
        ? {
              from: data.meta?.from ?? data.from,
              to: data.meta?.to ?? data.to,
              total: total,
          }
        : undefined;

    return (
        <div className="flex min-h-0 flex-1 flex-col">
            <h3 className="mb-4 flex-none text-sm font-semibold tracking-wider text-muted-foreground uppercase">
                Registros Existentes ({total}){!isPaginated && <span className="ml-2 text-[10px] font-normal lowercase">(vista cuadrícula)</span>}
                {isPaginated && <span className="ml-2 text-[10px] font-normal lowercase">(vista lista)</span>}
            </h3>

            <div className="flex-1 overflow-y-auto pr-2 pb-2">
                {items.length === 0 ? (
                    <div className="rounded-md border border-dashed bg-muted/20 p-8 text-center text-sm text-muted-foreground italic">
                        No hay registros creados aún.
                    </div>
                ) : (
                    <>
                        {/* VISTA GRID (Pocos datos) */}
                        {!isPaginated && (
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                {items.map((item) => renderCard(item))}
                            </div>
                        )}

                        {/* VISTA LISTA (Muchos datos + Paginación) */}
                        {isPaginated && <div className="flex flex-col space-y-2">{items.map((item) => renderRow(item))}</div>}
                    </>
                )}
            </div>

            {/* Paginación (Solo si es paginado) */}
            {isPaginated && links && metaInfo && (
                <div className="mt-auto border-t pt-4">
                    <Pagination links={links} meta={metaInfo} />
                </div>
            )}
        </div>
    );
}
