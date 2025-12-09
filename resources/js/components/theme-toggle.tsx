import { useAppearance } from '@/hooks/use-appearance';
import { MoonStar, Sun } from 'lucide-react';

import { Button } from '@/components/ui/button';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { useEffect, useState } from 'react';

export function ThemeToggle() {
    const { updateAppearance, appearance } = useAppearance();

    const [currentTheme, setCurrentTheme] = useState(appearance);

    useEffect(() => {
        setCurrentTheme(appearance);
    }, [appearance]);

    const toggleTheme = () => {
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
        updateAppearance(nextTheme);
    };

    return (
        // --- 2. ENVUELVE TODO CON EL PROVIDER Y EL TOOLTIP ---
        <TooltipProvider delayDuration={0}>
            <Tooltip>
                <TooltipTrigger asChild>
                    <Button variant="ghost" size="icon" className="group h-9 w-9 cursor-pointer" onClick={toggleTheme}>
                        <span className="relative flex items-center justify-center">
                            <Sun className="!size-6 scale-100 rotate-0 text-yellow-500 transition-all dark:scale-0 dark:-rotate-90" />
                            <MoonStar className="absolute !size-6 scale-0 rotate-90 text-sky-500 transition-all dark:scale-100 dark:rotate-0" />
                        </span>
                        <span className="sr-only">Toggle theme</span>
                    </Button>
                </TooltipTrigger>
                <TooltipContent>
                    {/* --- 3. AÑADE EL CONTENIDO DEL TOOLTIP --- */}
                    <p>Cambiar tema</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    );
}
