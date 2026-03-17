import { type ReactNode, useRef, useState } from 'react';
import { createPortal } from 'react-dom';

interface CustomTooltipProps {
    text: string;
    children: ReactNode;
}

export function CustomTooltip({ text, children }: CustomTooltipProps) {
    const [visible, setVisible] = useState(false);
    const [coords, setCoords] = useState({ top: 0, left: 0 });
    const triggerRef = useRef<HTMLDivElement>(null);

    const handleMouseEnter = () => {
        if (triggerRef.current) {
            const rect = triggerRef.current.getBoundingClientRect();
            setCoords({
                top: rect.top - 8,
                left: rect.left + rect.width / 2,
            });
        }
        setVisible(true);
    };

    return (
        <div
            ref={triggerRef}
            className="inline-flex"
            onMouseEnter={handleMouseEnter}
            onMouseLeave={() => setVisible(false)}
        >
            {children}
            {visible &&
                createPortal(
                    <div
                        style={{
                            position: 'fixed',
                            top: coords.top,
                            left: coords.left,
                            transform: 'translateX(-50%) translateY(-100%)',
                            zIndex: 9999,
                            pointerEvents: 'none',
                        }}
                        className="whitespace-nowrap rounded bg-gray-900 px-2 py-1 text-xs text-white dark:bg-gray-700"
                    >
                        {text}
                        <div className="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-900 dark:border-t-gray-700" />
                    </div>,
                    document.body,
                )}
        </div>
    );
}
