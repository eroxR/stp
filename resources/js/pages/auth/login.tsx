import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
// import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
import { request } from '@/routes/password';
// import { register } from '@/routes';
import { Head, useForm } from '@inertiajs/react';
import { Eye, EyeOff, LoaderCircle } from 'lucide-react';
import { useState } from 'react'; // <-- Importa useState
import Swal from 'sweetalert2';
// import withReactContent from 'sweetalert2-react-content';

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
}

// const MySwal = withReactContent(Swal);

export default function Login({ status, canResetPassword }: LoginProps) {
    // 2. CREA UNA INSTANCIA DEL FORMULARIO USANDO useForm
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        // remember: false,
    });

    const [showPassword, setShowPassword] = useState(false);

    // Función que se ejecutará al enviar el formulario
    const submit = (e: React.FormEvent) => {
        e.preventDefault();

        // 3. LLAMA A post() CON EL CALLBACK onError
        post(AuthenticatedSessionController.store.url(), {
            onError: (formErrors) => {
                const errorMessage = formErrors.email || 'Ha ocurrido un error inesperado.';

                Swal.fire({
                    icon: 'error',
                    title: '¡Error de Autenticación!',
                    text: errorMessage,
                    confirmButtonColor: '#d33',
                });
            },
            onSuccess: () => {
                reset('password'); // Limpia la contraseña si el login es exitoso
            },
        });
    };

    return (
        <AuthLayout title="Log in to your account" description="Enter your email and password below to log in">
            <Head title="Log in" />

            <form onSubmit={submit} className="flex flex-col gap-6">
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <Label htmlFor="email">Email o UserName</Label>
                        <Input
                            id="email"
                            type="text"
                            name="email"
                            value={data.email} // <-- Vincula al estado del formulario
                            onChange={(e) => setData('email', e.target.value)}
                            required
                            autoFocus
                            tabIndex={1}
                            autoComplete="email"
                            placeholder="email@example.com"
                        />
                        <InputError message={errors.email} />
                    </div>

                    <div className="grid gap-2">
                        <div className="flex items-center">
                            <Label htmlFor="password">Password</Label>
                            {canResetPassword && (
                                <TextLink href={request()} className="ml-auto text-sm" tabIndex={5}>
                                    Forgot password?
                                </TextLink>
                            )}
                        </div>
                        <div className="relative">
                            <Input
                                id="password"
                                type={showPassword ? 'text' : 'password'}
                                name="password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                                required
                                tabIndex={2}
                                autoComplete="current-password"
                                placeholder="Password"
                                className="pr-10"
                            />
                            <Button
                                type="button" // Importante para que no envíe el formulario
                                variant="ghost"
                                size="icon"
                                className="absolute inset-y-0 right-0 h-full px-3 text-muted-foreground hover:text-foreground"
                                // 5. El onClick cambia el estado de visibilidad
                                onClick={() => setShowPassword((prev) => !prev)}
                                tabIndex={-1} // Evita que el usuario llegue a este botón con la tecla Tab
                            >
                                {showPassword ? <EyeOff className="h-4 w-4" /> : <Eye className="h-4 w-4" />}
                                <span className="sr-only">{showPassword ? 'Hide password' : 'Show password'}</span>
                            </Button>
                        </div>
                        <InputError message={errors.password} />
                    </div>

                    {/* <div className="flex items-center space-x-3">
                        <Checkbox
                            id="remember"
                            name="remember"
                            checked={data.remember}
                            onCheckedChange={(checked) => setData('remember', !!checked)}
                            tabIndex={3}
                        />
                        <Label htmlFor="remember">Remember me</Label>
                    </div> */}

                    <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                        {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                        Log in
                    </Button>
                </div>

                {/* <div className="text-center text-sm text-muted-foreground">
                                Don't have an account?{' '}
                                <TextLink href={register()} tabIndex={5}>
                                    Sign up
                                </TextLink>
                            </div> */}
            </form>

            {status && <div className="mb-4 text-center text-sm font-medium text-green-600">{status}</div>}
        </AuthLayout>
    );
}
