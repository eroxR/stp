import SidebarLayout from '@/components/sidebar-layout';
import AppLayout from '@/layouts/app-layout';
import { useState } from 'react';

export default function MainMaster() {
    const [activeItem, setActiveItem] = useState('item1');

    const menuSections = [
        {
            title: 'Mi Sección',
            items: [
                { id: 'item1', label: 'Item 1' },
                { id: 'item2', label: 'Item 2' },
            ],
        },
    ];

    return (
        <AppLayout>
            <SidebarLayout
                title="Mi Página"
                version="v2.0.0"
                versions={[{ id: 'v2.0.0', label: 'v2.0.0', current: true }]}
                menuSections={menuSections}
                activeMenuItem={activeItem}
                onMenuItemChange={setActiveItem}
                children={undefined}
            >
                {/* Tu contenido aquí */}
            </SidebarLayout>
        </AppLayout>
    );
}
