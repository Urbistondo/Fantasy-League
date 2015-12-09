package Clases;

import java.util.ArrayList;
import java.util.Scanner;

import Excepciones.ExcepcionListaVacia;

public class Liga
{
	protected String nombre;
	protected String contraseña;
	protected ArrayList <Club> clubes = new ArrayList <Club> ();
	protected static ArrayList <Club> totalclubes = new ArrayList <Club> ();
	public Liga ()
	{
		System.out.println("Introduce un nombre para tu liga");
		Scanner reader = new Scanner (System.in);
		this.nombre = reader.nextLine();
		System.out.println("Introduce una contraseña para tu liga");
		this.contraseña = reader.nextLine();
	}
	
	public static void verLiga ()
	{
		for (int i = 0; i < Main.ligas.size(); i++)
		{
			System.out.println((i + 1) + ".- " + Main.ligas.get(i).nombre);
		}
	}
	
	public static void verEquiposLiga (int eleccionliga) throws ExcepcionListaVacia
	{
		if (Main.ligas.get(eleccionliga - 1).clubes.size() == 0)
		{
			throw new ExcepcionListaVacia ();
		}
		for (int i = 0; i < Main.ligas.get(eleccionliga - 1).clubes.size(); i++)
		{
			System.out.println("\n" + Main.ligas.get(eleccionliga - 1).clubes.get(i).nombre + ": " + Main.ligas.get(eleccionliga - 1).clubes.get(i).obtenerPuntuacion() + " puntos");
		}
	}
}
