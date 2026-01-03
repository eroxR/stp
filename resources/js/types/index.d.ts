import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';

export interface Auth {
    user: User;

    notifications: {
        list: Alert[];
        count: number;
    };
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

export interface AlertType {
    id: number;
    name: string;
    description: string;
    severity_level: string; // '1', '2', '3'
}

export interface AlertStatus {
    id: number;
    name: string;
    description_statusalert: string;
    icon_description: string; // 'Check', 'Info', etc.
}


export interface Alert {
    id: number;
    title_alert: string;
    description_alert: string;
    created_at: string;
    alertstatus_id: number;
    alerttype_id: number;
    alert_type?: AlertType;
    updated_at: string; // <--- Asegúrate de tener este

    // Este campo es importante para tu lógica de "Leído"
    alert_attention_date?: string | null;

    // Laravel serializa 'alertStatus' -> 'alert_status'
    alert_status?: AlertStatus;
    type?: AlertType;
    status?: AlertStatus;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        // CORRECCIÓN 2: Reemplazamos 'any' por la interfaz 'User' que ya definiste arriba.
        user: User;
        notifications: {
            list: Alert[];
            count: number;
        };
    };
};