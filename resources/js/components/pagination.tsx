import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/react';
import { ChevronLeft, ChevronRight } from 'lucide-react';

interface PaginationProps {
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    meta?: {
        from: number;
        to: number;
        total: number;
    };
}

export default function Pagination({ links, meta }: PaginationProps) {
    // Si solo hay 1 página, no mostrar nada
    if (links.length === 3) return null;

    return (
        <div className="flex items-center justify-between border-t px-2 py-4">
            {meta && (
                <div className="text-sm text-muted-foreground">
                    Mostrando <strong>{meta.from}</strong> a <strong>{meta.to}</strong> de <strong>{meta.total}</strong> resultados
                </div>
            )}

            <div className="flex items-center gap-1">
                {links.map((link, key) => {
                    // Convertir etiquetas HTML de Laravel (&laquo;) a texto simple
                    const label = link.label;
                    if (label.includes('&laquo;'))
                        return (
                            <Link key={key} href={link.url || '#'} preserveScroll preserveState>
                                <Button variant="outline" size="icon" disabled={!link.url}>
                                    <ChevronLeft className="h-4 w-4" />
                                </Button>
                            </Link>
                        );
                    if (label.includes('&raquo;'))
                        return (
                            <Link key={key} href={link.url || '#'} preserveScroll preserveState>
                                <Button variant="outline" size="icon" disabled={!link.url}>
                                    <ChevronRight className="h-4 w-4" />
                                </Button>
                            </Link>
                        );

                    return (
                        <Link key={key} href={link.url || '#'} preserveScroll preserveState>
                            <Button variant={link.active ? 'default' : 'outline'} size="sm" disabled={!link.url} className="min-w-[32px]">
                                {label}
                            </Button>
                        </Link>
                    );
                })}
            </div>
        </div>
    );
}
