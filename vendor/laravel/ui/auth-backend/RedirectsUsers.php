<?php

namespace Illuminate\Foundation\Auth;

use DB;
use Illuminate\Support\Facades\Session;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath($correo)
    {

        //Llamar un procedimiento para comparar el correo.
        $users = DB::select("select * from buscarUsuarioEmail('$correo')");



        foreach ($users as $user) {
            if ($user->idTipoUsuario == 1) {
                if (method_exists($this, 'redirectCustomer')) {
                    return $this->redirectCustomer();
                }

                session()->regenerate();


                $clientes = DB::select("select * from clientes where \"emailCliente\" = '$correo' ");
                foreach ($clientes as $key => $value) {
                    Session::put('idCliente', $value->idCliente);
                    Session::put('nombreCliente', $value->nombreCliente);
                    Session::put('apellidoCliente', $value->apellidoCliente);
                    Session::put('telefonoCliente', $value->telefonoCliente);
                    Session::put('generoCliente', $value->generoCliente);
                    Session::put('idTipoIdentificacion', $value->idTipoIdentificacion);
                    Session::put('cedulaCliente', $value->cedulaCliente);
                    Session::put('emailCliente', $value->emailCliente);
                }


                return property_exists($this, 'redirectCustomer') ? $this->redirectCustomer : '/customer';
            } elseif ($user->idTipoUsuario == 2) {
                if (method_exists($this, 'redirectAdmin')) {
                    return $this->redirectAdmin();
                }

                return property_exists($this, 'redirectAdmin') ? $this->redirectAdmin : '/admin';
            } elseif ($user->idTipoUsuario == 3) {
                if (method_exists($this, 'redirectOwner')) {
                    return $this->redirectOwner();
                }

                return property_exists($this, 'redirectOwner') ? $this->redirectOwner : '/owner';
            } elseif ($user->idTipoUsuario == 4) {
                if (method_exists($this, 'redirectDomi')) {
                    return $this->redirectDomi();
                }

                session()->regenerate();


                $domiciliarios = DB::select("select * from domiciliarios where \"emailDomiciliario\" = '$correo' ");
                foreach ($domiciliarios as $key => $value) {
                    Session::put('cedulaDomiciliario', $value->cedulaDomiciliario);
                    Session::put('nombreDomiciliario', $value->nombreDomiciliario);
                    Session::put('apellidoDomiciliario', $value->apellidoDomiciliario);
                    Session::put('telefonoDomiciliario', $value->telefonoDomiciliario);
                    Session::put('generoDomiciliario', $value->genderDomiciliario);                    Session::put('cedulaDomiciliario', $value->cedulaDomiciliario);
                    Session::put('emailDomiciliario', $value->emailDomiciliario);
                }

                return property_exists($this, 'redirectDomi') ? $this->redirectDomi : '/domiciliary';
            } elseif ($user->idTipoUsuario == 5) {
                if (method_exists($this, 'redirectVendor')) {
                    return $this->redirectVendor();
                }

                return property_exists($this, 'redirectVendor') ? $this->redirectVendor : '/vendor';
            }
        }
    }
    public function redirectPathReAny()
    {

        //condicionales para validar tipo usuario
        if (method_exists($this, 'redirectToAny')) {
            return $this->redirectToAny();
        }
        return property_exists($this, 'redirectToAny') ? $this->redirectToAny : '/usuarios';
    }

    public function redirectPathReDomi()
    {

        //condicionales para validar tipo usuario
        if (method_exists($this, 'redirectToDomi')) {
            return $this->redirectToDomi();
        }
        return property_exists($this, 'redirectToDomi') ? $this->redirectToDomi : '/domiciliary/register';
    }
    public function redirectPathReCl()
    {

        //condicionales para validar tipo usuario
        if (method_exists($this, 'redirectToClient')) {
            return $this->redirectToClient();
        }
        return property_exists($this, 'redirectToClient') ? $this->redirectToClient : '/customers/register';
    }
}
