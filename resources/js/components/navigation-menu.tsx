import type { NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { ChevronDown } from 'lucide-react';
import { useEffect, useRef, useState } from 'react';

interface NavigationMenuProps {
    items: NavItem[];
    isMobile?: boolean;
}

interface MenuPosition {
    left: number;
    width: number;
}

export const NavigationMenu: React.FC<NavigationMenuProps> = ({ items, isMobile = false }) => {
    const [activeMenu, setActiveMenu] = useState<number | null>(null);
    const [menuPosition, setMenuPosition] = useState<MenuPosition>({ left: 0, width: 0 });
    const [isTransitioning, setIsTransitioning] = useState<boolean>(false);
    const [dropdownWidth, setDropdownWidth] = useState<number>(0);
    const menuRefs = useRef<{ [key: number]: HTMLDivElement | null }>({});
    const contentRefs = useRef<{ [key: number]: HTMLDivElement | null }>({});
    const timeoutRef = useRef<NodeJS.Timeout | null>(null);

    const handleMouseEnter = (index: number): void => {
        if (isMobile) return;

        if (timeoutRef.current) {
            clearTimeout(timeoutRef.current);
        }

        const menuElement = menuRefs.current[index];
        if (menuElement && menuElement.parentElement) {
            const rect = menuElement.getBoundingClientRect();
            const parentRect = menuElement.parentElement.getBoundingClientRect();

            setMenuPosition({
                left: rect.left - parentRect.left,
                width: rect.width,
            });
        }

        // Calcular el ancho del contenido del dropdown
        setTimeout(() => {
            const contentElement = contentRefs.current[index];
            if (contentElement) {
                // Forzar un reflow para asegurar que el grid esté calculado
                void contentElement.offsetHeight;
                const contentWidth = contentElement.scrollWidth + 4; // +4 para padding extra
                setDropdownWidth(contentWidth);
            }
        }, 10); // Aumenté a 10ms para dar tiempo al grid

        if (activeMenu !== null && activeMenu !== index) {
            setIsTransitioning(true);
            setTimeout(() => {
                setActiveMenu(index);
                setIsTransitioning(false);
            }, 150);
        } else {
            setActiveMenu(index);
        }
    };

    const handleMouseLeave = (): void => {
        if (isMobile) return;

        timeoutRef.current = setTimeout(() => {
            setActiveMenu(null);
            setIsTransitioning(false);
        }, 200); // Aumenté el delay a 200ms para dar más tiempo
    };

    const toggleMobileMenu = (index: number): void => {
        setActiveMenu(activeMenu === index ? null : index);
    };

    useEffect(() => {
        return () => {
            if (timeoutRef.current) {
                clearTimeout(timeoutRef.current);
            }
        };
    }, []);

    const getHref = (href: NavItem['href']): string => {
        if (!href) return '#';
        return typeof href === 'string' ? href : href.url;
    };

    if (isMobile) {
        return (
            <div className="flex flex-col space-y-2">
                {items.map((item: NavItem, index: number) => {
                    const Icon = item.icon;
                    const hasSubItems = item.subItems && item.subItems.length > 0;
                    const isActive = activeMenu === index;

                    return (
                        <div key={index}>
                            {hasSubItems ? (
                                <>
                                    <button
                                        onClick={() => toggleMobileMenu(index)}
                                        className="flex w-full items-center justify-between rounded-md px-3 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-800"
                                    >
                                        <div className="flex items-center space-x-2">
                                            {Icon && <Icon className="h-5 w-5" />}
                                            <span>{item.title}</span>
                                        </div>
                                        <ChevronDown className={`h-4 w-4 transition-transform duration-200 ${isActive ? 'rotate-180' : ''}`} />
                                    </button>
                                    {isActive && item.subItems && (
                                        <div className="mt-1 ml-7 space-y-1">
                                            {item.subItems.map((subItem, subIndex: number) => (
                                                <Link
                                                    key={subIndex}
                                                    href={getHref(subItem.href)}
                                                    className="block rounded-md px-3 py-2 text-sm text-neutral-600 capitalize hover:bg-neutral-100 dark:text-neutral-400 dark:hover:bg-neutral-800"
                                                >
                                                    {subItem.title}
                                                </Link>
                                            ))}
                                        </div>
                                    )}
                                </>
                            ) : (
                                <Link
                                    href={getHref(item.href)}
                                    className="flex items-center space-x-2 rounded-md px-3 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-800"
                                >
                                    {Icon && <Icon className="h-5 w-5" />}
                                    <span>{item.title}</span>
                                </Link>
                            )}
                        </div>
                    );
                })}
            </div>
        );
    }

    return (
        <div className="relative" onMouseLeave={handleMouseLeave}>
            <div className="flex items-center space-x-1">
                {items.map((item: NavItem, index: number) => {
                    const Icon = item.icon;
                    const hasSubItems = item.subItems && item.subItems.length > 0;
                    const isActive = activeMenu === index;

                    return (
                        <div
                            key={index}
                            ref={(el: HTMLDivElement | null) => {
                                menuRefs.current[index] = el;
                            }}
                            className="relative"
                            onMouseEnter={() => hasSubItems && handleMouseEnter(index)}
                        >
                            {hasSubItems ? (
                                <button
                                    className={`flex items-center space-x-2 rounded-md px-4 py-2 text-sm font-medium transition-colors duration-200 ${
                                        isActive
                                            ? 'bg-neutral-100 text-neutral-900 dark:bg-neutral-800 dark:text-neutral-100'
                                            : 'text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 dark:text-neutral-400 dark:hover:bg-neutral-800/50 dark:hover:text-neutral-100'
                                    }`}
                                >
                                    {Icon && <Icon className="h-4 w-4" />}
                                    <span>{item.title}</span>
                                    <ChevronDown className={`h-4 w-4 transition-transform duration-200 ${isActive ? 'rotate-180' : ''}`} />
                                </button>
                            ) : (
                                <Link
                                    href={getHref(item.href)}
                                    className="flex items-center space-x-2 rounded-md px-4 py-2 text-sm font-medium text-neutral-600 transition-colors duration-200 hover:bg-neutral-50 hover:text-neutral-900 dark:text-neutral-400 dark:hover:bg-neutral-800/50 dark:hover:text-neutral-100"
                                >
                                    {Icon && <Icon className="h-4 w-4" />}
                                    <span>{item.title}</span>
                                </Link>
                            )}
                        </div>
                    );
                })}
            </div>

            <div
                className={`absolute top-full right-0 left-0 mt-2 transition-opacity duration-200 ${
                    activeMenu !== null ? 'pointer-events-auto opacity-100' : 'pointer-events-none opacity-0'
                }`}
                onMouseEnter={() => {
                    if (timeoutRef.current) {
                        clearTimeout(timeoutRef.current);
                    }
                }}
            >
                <div className="relative">
                    <div
                        className="absolute inset-0 rounded-lg border border-neutral-200 bg-white/95 shadow-lg backdrop-blur-sm dark:border-neutral-800 dark:bg-neutral-900/95"
                        style={{
                            left: `${menuPosition.left}px`,
                            width: `${dropdownWidth}px`,
                            transition: 'left 300ms cubic-bezier(0.4, 0, 0.2, 1), width 300ms cubic-bezier(0.4, 0, 0.2, 1)',
                        }}
                    />

                    {items.map((item: NavItem, index: number) => {
                        if (!item.subItems || item.subItems.length === 0) return null;

                        const isVisible = activeMenu === index;

                        return (
                            <div
                                key={index}
                                ref={(el: HTMLDivElement | null) => {
                                    contentRefs.current[index] = el;
                                }}
                                className={`relative p-3 transition-all duration-200 ${
                                    isVisible ? 'translate-y-0 opacity-100' : 'pointer-events-none -translate-y-2 opacity-0'
                                } ${isTransitioning ? 'transition-none' : ''}`}
                                style={{
                                    left: `${menuPosition.left}px`,
                                    width: 'max-content',
                                    position: isVisible ? 'relative' : 'absolute',
                                    top: 0,
                                }}
                            >
                                <div className={`${item.subItems.length > 6 ? 'grid grid-cols-2 gap-x-4 gap-y-1' : 'flex flex-col space-y-1'}`}>
                                    {item.subItems.map((subItem, subIndex: number) => (
                                        <Link
                                            key={subIndex}
                                            href={getHref(subItem.href)}
                                            className="block rounded-md px-3 py-2 text-sm whitespace-nowrap text-neutral-700 capitalize transition-colors duration-150 hover:bg-neutral-100 hover:text-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:hover:text-neutral-100"
                                        >
                                            {subItem.title}
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        );
                    })}
                </div>
            </div>
        </div>
    );
};
