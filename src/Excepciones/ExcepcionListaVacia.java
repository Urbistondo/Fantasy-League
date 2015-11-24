package Excepciones;

public class ExcepcionListaVacia extends Exception
{
	public ExcepcionListaVacia ()
	{
		super ("\n" + "No existen elementos en la lista");
	}
}
