<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;                    // Para usar el modelo User
use App\Models\Insumo;    
use Illuminate\Support\Facades\Hash;    // Para usar Hash::make
use Illuminate\Support\Facades\Auth;    // Para usar Auth::login y Auth::attempt
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use App\Enums\UserRole;

class AuthController extends Controller
{
    /**
     * Procesa el intento de inicio de sesión.
     */
    public function login(Request $request)
{
    // 1. Validamos los datos (Falla aquí dispara el FL105 de tu tabla)
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // 2. Intento de autenticación
    if (Auth::attempt($credentials)) {
        
        $request->session()->regenerate(); // Seguridad contra fijación de sesión
        $user = Auth::user(); 

        // 3. Preparamos el mensaje dinámico con Rol y Nombre
        $roleLabel = strtoupper($user->role->value ?? $user->role);
        $welcomeMsg = "ACCESO CONCEDIDO: BIENVENIDO, $roleLabel " . strtoupper($user->name);

        // 3. Redirección estratégica con mensaje de éxito (FL101)
        return match($user->role) {
            UserRole::ADMIN    => redirect()->intended('/admin/dashboard')->with('success', $welcomeMsg),
            UserRole::DELIVERY => redirect()->intended('/delivery/dashboard')->with('success', $welcomeMsg),
            UserRole::BUYER    => redirect()->intended('/shop')->with('success', $welcomeMsg),
            default            => redirect('/')->with('success', "BIENVENIDO A FLORENTICA"),
        };
    }

    // 5. Fallo de autenticación (FL102)
    return back()->withErrors([
        'error' => 'FL102: Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('email'); 
}
    /**
     * Cierra la sesión del usuario.
     */
    /**
     * Muestra el formulario de inicio de sesión.
     * ESTO ES LO QUE FALTABA Y CAUSABA EL ERROR.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Cierra la sesión del usuario.
     * Modificado para mayor estabilidad.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Limpieza profunda de sesión para evitar conflictos
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigimos al login con un mensaje de despedida elegante
        return redirect()->route('login')->with('success', 'Sesión terminada. ¡Vuelve pronto a Florentica!');
    }

public function register(Request $request) 
{
    // 1. Definimos las reglas (Tu código actual)
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
    ];

    // 2. Definimos los mensajes en ESPAÑOL (La solución)
    $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.unique' => 'FL104: Este correo ya forma parte de la familia Florentica.',
        'email.email' => 'Por favor, ingresa un correo válido.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.letters' => 'La contraseña debe contener al menos una letra y un simbolo',
        'password.numbers' => 'La contraseña debe contener al menos un número.',
    ];

    // 3. Validar pasando Reglas + Mensajes
    $request->validate($rules, $messages);

    // ... (El resto de tu lógica de roles y creación de usuario se queda igual)
    $role = str_contains(url()->previous(), 'join-delivery') 
            ? UserRole::DELIVERY 
            : UserRole::BUYER;

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $role,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->route('verification.notice');
}

public function adminDashboard()
{
    // 1. Recolectamos toda la inteligencia del negocio
    $usuarios = User::all(); 
    $insumos = Insumo::all(); 
    
    // 2. Opcional: Puedes contar totales para las tarjetitas del Dashboard
    $totalUsuarios = $usuarios->count();
    $totalInsumos = $insumos->count();

    // 3. Enviamos TODO en un solo paquete a la vista
    return view('admin.dashboard', compact('usuarios', 'insumos', 'totalUsuarios', 'totalInsumos'));
}

}