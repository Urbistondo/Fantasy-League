package Clases;

import java.util.ArrayList;
import java.util.Random;
import java.util.Scanner;
import java.util.Date;

public class Mercado
{
	protected static ArrayList <Jugador> jugadores = new ArrayList <Jugador> ();
	protected static ArrayList <Jugador> transferibles = new ArrayList <Jugador> ();
	protected static ArrayList <Jugador> porteros = new ArrayList <Jugador> ();
	protected static ArrayList <Jugador> defensas = new ArrayList <Jugador> ();
	protected static ArrayList <Jugador> centrocampistas = new ArrayList <Jugador> ();
	protected static ArrayList <Jugador> delanteros = new ArrayList <Jugador> ();
	protected static boolean renovar = false;
	
	public Mercado ()
	{
		if (renovar)
		{
			borrarTransferibles();
			Random azar = new Random ();
			for (int i = 0; i < 10;)
			{
				int random = azar.nextInt(92);
				if(jugadores.get(random).mercado == false)
				{
					jugadores.get(random).mercado = true;
					transferibles.add(jugadores.get(random));
					i++;
				}
			}
		}
	}
	
	public static void imprimirMercado ()
	{
		Date reloj = new Date();
		long tiempofinal = reloj.getTime();
		if (((tiempofinal - Main.tiempoinicial)/60000) >= 5)
		{
			renovar = true;
			new Mercado();
			renovar = false;
		}
		System.out.println("MERCADO");
		for (int i = 0; i < transferibles.size(); i++)
		{
			System.out.println(transferibles.get(i).codigo + " " + transferibles.get(i).nombre + " " + transferibles.get(i).apellido + " " + transferibles.get(i).equipo + " " + transferibles.get(i).posicion);
		}
		Main.tiempoinicial = reloj.getTime();
	}
	
	public void ficharJugador (Club e)
	{
		boolean exito = true;
		boolean existente = false;
		System.out.println("\n" + "Introduce el código del jugador que deseas fichar");
		Scanner reader = new Scanner (System.in);
		int codigo = reader.nextInt();
		for (int i = 0; i < transferibles.size(); i++)
		{
			if (codigo == transferibles.get(i).codigo)
			{
				for (int j = 0; j < e.equipo.size(); j++)
				{
					if (e.equipo.get(j).codigo == codigo)
					{
						System.out.println("Este jugador ya está en tu equipo");
						exito = false;
						existente = true;
						break;
					}
				}
				if ((e.presupuesto >= transferibles.get(i).precio) && existente == false)
				{
					e.añadirJugador(transferibles.get(i));
					System.out.println("Has fichado a " + transferibles.get(i).nombre + " " + transferibles.get(i).apellido);
					e.fichajes = e.fichajes - 1;
					exito = false;
				}
				if ((e.presupuesto < transferibles.get(i).precio) && existente == false)
				{
					System.out.println("No tienes dinero suficiente para fichar a este jugador");
				}
			}
		}
		if (exito == true)
		{
			System.out.println("Has introducido un código erróneo");
		}
	}
	
	public void venderJugador (Club e)
	{
		e.imprimirEquipo();
		System.out.println("\n" + "Introduce el código del jugador que deseas vender");
		Scanner reader = new Scanner (System.in);
		int codigo = reader.nextInt();
		for (int i = 0; i < e.equipo.size(); i++)
		{
			if (e.equipo.get(i).codigo == codigo)
			{
				System.out.println("Tu jugador " + e.equipo.get(i).nombre + " " + e.equipo.get(i).apellido + " ha sido añadido al mercado de fichajes");
				transferibles.add(e.equipo.get(i));
				e.borrarJugador(e.equipo.get(i));
				break;
			}
		}
		
	}
	
	public void verJugador(int eleccionjugador)
	{
		for (int i = 0; i < transferibles.size(); i++)
		{
			if (transferibles.get(i).codigo == eleccionjugador)
			{
				System.out.println("\n" + transferibles.get(i).nombre + " " + transferibles.get(i).apellido);
				System.out.print(transferibles.get(i).codigo + " " + transferibles.get(i).equipo + " " + transferibles.get(i).posicion + " " + transferibles.get(i).precio);
				if (transferibles.get(i).lesion == true)
				{
					System.out.println("Lesionado");
				}
			}
		}
	}
	
	public void fichajesIniciales(Club e)
	{
		Random azar = new Random ();
		int numero;
		int numeroauxiliar1 = 0;
		
		//Creamos una lista para cada posicion
		for (int i = 0; i < jugadores.size(); i++)
		{
			if (jugadores.get(i).posicion.equals("Portero"))
			{
				porteros.add(jugadores.get(i));
			}
			else if (jugadores.get(i).posicion.equals("Defensa"))
			{
				defensas.add(jugadores.get(i));
			}
			else if (jugadores.get(i).posicion.equals("Centrocampista"))
			{
				centrocampistas.add(jugadores.get(i));
			}
			else if (jugadores.get(i).posicion.equals("Delantero"))
			{
				delanteros.add(jugadores.get(i));
			}
		}
		
		//Elegimos 2 porteros
		do
		{
			numeroauxiliar1 = 0;
			numero = azar.nextInt(porteros.size());
			for (int i = 0; i < e.equipo.size(); i++)
			{
				if (e.equipo.get(i).codigo == porteros.get(numero).codigo)
				{
					numeroauxiliar1++;
				}
			}
			if (numeroauxiliar1 == 0)
			{
				e.equipo.add(porteros.get(numero));
			}
		}
		while (e.equipo.size() < 2);
		
		//Elegimos 5 defensas
		do
		{
			numeroauxiliar1 = 0;
			numero = azar.nextInt(defensas.size());
			for (int i = 0; i < e.equipo.size(); i++)
			{
				if (e.equipo.get(i).codigo == defensas.get(numero).codigo)
				{
					numeroauxiliar1++;
				}
			}
			if (numeroauxiliar1 == 0)
			{
				e.equipo.add(defensas.get(numero));
			}
		}
		while (e.equipo.size() < 7);
		
		//Elegimos 4 centrocampistas
		do
		{
			numeroauxiliar1 = 0;
			numero = azar.nextInt(centrocampistas.size());
			for (int i = 0; i < e.equipo.size(); i++)
			{
				if (e.equipo.get(i).codigo == centrocampistas.get(numero).codigo)
				{
					numeroauxiliar1++;
				}
			}
			if (numeroauxiliar1 == 0)
			{
				e.equipo.add(centrocampistas.get(numero));
			}
		}
		while (e.equipo.size() < 11);
				
		//Elegimos 4 delanteros
		do
		{
			numeroauxiliar1 = 0;
			numero = azar.nextInt(delanteros.size());
			for (int i = 0; i < e.equipo.size(); i++)
			{
				if (e.equipo.get(i).codigo == delanteros.get(numero).codigo)
				{
					numeroauxiliar1++;
				}
			}
			if (numeroauxiliar1 == 0)
			{
				e.equipo.add(delanteros.get(numero));
			}
		}
		while (e.equipo.size() < 15);
		
	}
	
	public void borrarTransferibles ()
	{
		for (int i = 0; i < transferibles.size(); i++)
		{
			transferibles.get(i).mercado = false;
		}
		transferibles.clear();
	}
}