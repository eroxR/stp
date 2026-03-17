// import AppLayoutTemplate from '@/layouts/app/app-sidebar-layout';
import { Toaster } from '@/components/ui/sonner';
import { TooltipProvider } from '@/components/ui/tooltip';
import AppLayoutTemplate from '@/layouts/app/app-header-layout';
import { type BreadcrumbItem } from '@/types';
import { type ReactNode } from 'react';

interface AppLayoutProps {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
}

export default ({ children, breadcrumbs, ...props }: AppLayoutProps) => (
    <TooltipProvider>
        <AppLayoutTemplate breadcrumbs={breadcrumbs} {...props}>
            {children}
            {/* <Toaster richColors position="top-right" /> */}
            <Toaster richColors position="bottom-right" />
        </AppLayoutTemplate>
    </TooltipProvider>
);
