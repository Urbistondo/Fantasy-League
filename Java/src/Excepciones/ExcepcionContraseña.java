package Excepciones;

public class ExcepcionContraseña extends RuntimeException
{
	public ExcepcionContraseña ()
	{
		super("La contraseña no es correcta");
	}
}
