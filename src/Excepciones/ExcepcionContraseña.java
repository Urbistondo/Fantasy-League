package Excepciones;

public class ExcepcionContrase�a extends RuntimeException
{
	public ExcepcionContrase�a ()
	{
		super("La contrase�a no es correcta");
	}
}
