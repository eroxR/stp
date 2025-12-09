import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    isActive?: boolean;
    subItems?: NavSubItem[];
}

// export interface NavItem {
//     title: string;
//     href?: string | RouteDefinition; // 1. Haz que href sea opcional
//     icon?: LucideIcon;
//     subItems?: {    // 2. Añade la propiedad opcional subItems
//         title: string;
//         href: string;
//         description: string;
//     }[];
// }

export interface Permission {
    id: string;
    label: string;
    guard_name: string;
}

export interface PermissionsPageProps {
    permissions: Permission[];
}

export interface SharedData {
    names: string;
    id: number;
    firstname: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
    session: {
        lifetime_in_seconds: number;
    };
    [key: string]: unknown;
}

export interface User {
    names: string;
    id: number;
    firstname: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}
