// resources/js/components/list-item.tsx

// import { NavigationMenuLink } from '@/components/ui/navigation-menu';
// import { cn } from '@/lib/utils';
// import { Link as InertiaLink } from '@inertiajs/react';
// import * as React from 'react';

// interface ListItemProps {
//     className?: string;
//     title: string;
//     children: React.ReactNode;
//     href: string;
// }

// // 2. Usamos nuestra nueva interfaz en forwardRef y eliminamos {...props}
// const ListItem = React.forwardRef<HTMLAnchorElement, ListItemProps>(({ className, title, children, href }, ref) => {
//     return (
//         <li>
//             <NavigationMenuLink asChild>
//                 <InertiaLink
//                     href={href}
//                     ref={ref}
//                     className={cn(
//                         'block space-y-1 rounded-md p-3 leading-none no-underline transition-colors outline-none select-none hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground',
//                         className,
//                     )}
//                     // 3. Ya no pasamos {...props} aquí
//                 >
//                     <div className="text-sm leading-none font-medium">{title}</div>
//                     <p className="line-clamp-2 text-sm leading-snug text-muted-foreground">{children}</p>
//                 </InertiaLink>
//             </NavigationMenuLink>
//         </li>
//     );
// });
// ListItem.displayName = 'ListItem';

// export { ListItem };

// resources/js/components/ui/list-item.tsx

// import { NavigationMenuLink } from '@/components/ui/navigation-menu';
// import { cn } from '@/lib/utils';
// import { Link } from '@inertiajs/react';
// import * as React from 'react';

// Exportamos el componente para que pueda ser importado desde otros archivos
// export const ListItem = React.forwardRef<React.ElementRef<typeof Link>, React.ComponentPropsWithoutRef<typeof Link> & { title: string }>(
//     ({ className, title, children, href, ...props }, ref) => {
//         return (
//             <li>
//                 <NavigationMenuLink asChild>
//                     <Link
//                         ref={ref}
//                         href={href!}
//                         className={cn(
//                             'block space-y-1 rounded-md p-3 leading-none no-underline transition-colors outline-none select-none hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground',
//                             className,
//                         )}
//                         {...props}
//                     >
//                         <div className="text-sm leading-none font-medium">{title}</div>
//                         <p className="line-clamp-2 text-sm leading-snug text-muted-foreground">{children}</p>
//                     </Link>
//                 </NavigationMenuLink>
//             </li>
//         );
//     },
// );

// // Asignamos el displayName para facilitar la depuración en las herramientas de React
// ListItem.displayName = 'ListItem';

// En: @/components/list-item.tsx
// 'use client';

// import { cn } from '@/lib/utils';
// import { Link } from '@inertiajs/react';
// import { NavigationMenuLink } from '@radix-ui/react-navigation-menu';
// import * as React from 'react';

// export const ListItem = React.forwardRef<React.ElementRef<typeof Link>, React.ComponentPropsWithoutRef<typeof Link> & { title: string }>(
//     ({ className, title, children, ...props }, ref) => {
//         return (
//             <li>
//                 <NavigationMenuLink asChild>
//                     <Link
//                         ref={ref}
//                         className={cn(
//                             'block space-y-1 rounded-md p-3 leading-none no-underline transition-colors outline-none select-none hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground',
//                             className,
//                         )}
//                         {...props}
//                     >
//                         <div className="text-sm leading-none font-medium">{title}</div>
//                         <p className="line-clamp-2 text-sm leading-snug text-muted-foreground">{children}</p>
//                     </Link>
//                 </NavigationMenuLink>
//             </li>
//         );
//     },
// );
// ListItem.displayName = 'ListItem';
