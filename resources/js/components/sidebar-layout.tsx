import { ReactNode, useState } from 'react';

export interface MenuItem {
    id: string;
    label: string;
    icon?: string;
}

export interface MenuSection {
    title?: string;
    items: MenuItem[];
}

interface SidebarLayoutProps {
    title: string;
    version: string;
    versions: Array<{ id: string; label: string; current: boolean }>;
    menuSections: MenuSection[];
    activeMenuItem: string;
    onMenuItemChange: (itemId: string) => void;
    children: ReactNode;
    searchPlaceholder?: string;
    onSearch?: (query: string) => void;
}

export default function SidebarLayout({
    title,
    version,
    versions,
    menuSections,
    activeMenuItem,
    onMenuItemChange,
    children,
    searchPlaceholder = 'Search...',
    onSearch,
}: SidebarLayoutProps) {
    const [isDropdownOpen, setIsDropdownOpen] = useState(false);
    const [selectedVersion, setSelectedVersion] = useState(version);
    const [isSidebarOpen, setIsSidebarOpen] = useState(true);
    const [searchQuery, setSearchQuery] = useState('');

    const handleVersionSelect = (versionId: string) => {
        setSelectedVersion(versionId);
        setIsDropdownOpen(false);
    };

    const handleSearchChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const query = e.target.value;
        setSearchQuery(query);
        if (onSearch) {
            onSearch(query);
        }
    };

    return (
        <div className="relative flex h-[calc(100vh-4rem)] gap-4 p-4">
            {/* Sidebar */}
            <aside
                className={`${
                    isSidebarOpen ? 'w-64' : 'w-0'
                } fixed flex h-full flex-shrink-0 flex-col overflow-hidden rounded-xl border border-gray-800 bg-[#ffffff] shadow-lg transition-all duration-300 md:relative md:translate-x-0 ${
                    isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
                } top-0 left-0 z-30 md:z-auto dark:border-gray-700 dark:bg-[#1a1a1a]`}
            >
                {/* Header with Dropdown */}
                <div className="relative flex-shrink-0 p-4">
                    <button
                        onClick={() => setIsDropdownOpen(!isDropdownOpen)}
                        className="mb-4 flex w-full items-center gap-3 rounded-lg p-2 transition-colors hover:bg-[#f1090985] dark:hover:bg-[#2a2a2a]"
                    >
                        <div className="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-blue-600 dark:bg-blue-500">
                            <svg className="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                />
                            </svg>
                        </div>
                        <div className="flex-1 text-left">
                            <h3 className="text-sm font-semibold text-black dark:text-white">{title}</h3>
                            <p className="text-xs text-gray-400 dark:text-gray-500">{selectedVersion}</p>
                        </div>
                        <svg
                            className={`h-4 w-4 text-gray-400 transition-transform dark:text-gray-500 ${isDropdownOpen ? 'rotate-180' : ''}`}
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {/* Dropdown Menu */}
                    {isDropdownOpen && (
                        <div className="absolute top-20 right-4 left-4 z-50 rounded-lg border border-gray-700 bg-[#ffffff] py-2 shadow-xl dark:border-gray-600 dark:bg-[#2a2a2a]">
                            {versions.map((versionItem) => (
                                <button
                                    key={versionItem.id}
                                    onClick={() => handleVersionSelect(versionItem.id)}
                                    className="flex w-full items-center justify-between px-4 py-2 text-left text-sm text-black transition-colors hover:bg-[#3a3a3a] dark:text-gray-300 dark:hover:bg-[#3a3a3a]"
                                >
                                    <span>{versionItem.label}</span>
                                    {versionItem.id === selectedVersion && (
                                        <svg
                                            className="h-4 w-4 text-blue-500 dark:text-blue-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                        </svg>
                                    )}
                                </button>
                            ))}
                        </div>
                    )}

                    {/* Search */}
                    <div className="relative">
                        <input
                            type="text"
                            placeholder={searchPlaceholder}
                            value={searchQuery}
                            onChange={handleSearchChange}
                            className="w-full rounded-lg border border-gray-800 bg-[#ffffff] px-3 py-2 pl-9 text-sm text-white placeholder-gray-500 focus:ring-1 focus:ring-blue-500 focus:outline-none dark:bg-[#2a2a2a] dark:text-white dark:placeholder-gray-600"
                        />
                        <svg
                            className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-gray-500 dark:text-gray-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {/* Navigation */}
                <nav className="flex-1 overflow-y-auto px-3 pb-4">
                    {menuSections.map((section, sectionIndex) => (
                        <div key={sectionIndex} className="mb-6">
                            {section.title && (
                                <h4 className="mb-2 px-3 text-xs font-semibold tracking-wider text-black uppercase dark:text-white">
                                    {section.title}
                                </h4>
                            )}
                            <div className="space-y-1">
                                {section.items.map((item) => (
                                    <button
                                        key={item.id}
                                        onClick={() => onMenuItemChange(item.id)}
                                        className={`w-full rounded-lg px-3 py-2 text-left text-sm transition-colors duration-150 ${
                                            activeMenuItem === item.id
                                                ? 'bg-[#2a2a2a] font-medium text-white dark:bg-[#ff000070] dark:text-white'
                                                : 'text-gray-400 hover:bg-[#2a2a2a] hover:text-white dark:text-gray-500 dark:hover:bg-[#2a2a2a] dark:hover:text-white'
                                        }`}
                                    >
                                        {item.label}
                                    </button>
                                ))}
                            </div>
                        </div>
                    ))}
                </nav>
            </aside>

            {/* Toggle Sidebar Button */}
            <button
                onClick={() => setIsSidebarOpen(!isSidebarOpen)}
                className={`fixed z-20 flex h-8 w-8 items-center justify-center rounded-lg border border-gray-700 bg-[#ffffff] shadow-lg transition-all duration-300 hover:bg-[#2a2a2a] dark:border-gray-600 dark:bg-[#1a1a1a] dark:hover:bg-[#2a2a2a]`}
                style={{
                    left: isSidebarOpen ? 'calc(16rem + 1.5rem)' : '1.5rem',
                    top: '6rem',
                }}
            >
                <svg className="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            {/* Main Content */}
            <main
                className={`h-full flex-1 overflow-y-auto rounded-xl border border-gray-800 bg-white p-6 shadow-sm transition-all duration-300 dark:border-gray-700 dark:bg-gray-900 ${
                    !isSidebarOpen ? 'md:ml-0' : ''
                }`}
            >
                {children}
            </main>

            {/* Overlay para cerrar dropdown */}
            {isDropdownOpen && <div className="fixed inset-0 z-10" onClick={() => setIsDropdownOpen(false)} />}

            {/* Overlay para cerrar sidebar en móvil */}
            {isSidebarOpen && <div className="fixed inset-0 z-20 bg-black/50 md:hidden" onClick={() => setIsSidebarOpen(false)} />}
        </div>
    );
}
