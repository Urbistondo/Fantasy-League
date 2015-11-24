package Clases;

import java.util.ArrayList;
import java.util.Scanner;

import Excepciones.*;

public class Club
{
	protected String nombre;
	protected String contraseña;
	protected String liga;
	protected int puntosonce = 0;
	protected int fichajes = 15;
	protected double presupuesto = 20000000;
	protected ArrayList <Jugador> equipo = new ArrayList <Jugador> ();
	protected Jugador [] once = new Jugador [11];
	
	public Club (Mercado m, String nombreliga)
	{
		//El usuario elige el nombre de su equipo
		Scanner reader = new Scanner (System.in);
		System.out.println("Introduce el nombre de tu club");
		this.nombre = reader.nextLine();
		
		//El usuario elige una contraseña para su cuenta
		System.out.println("Elige una contraseña para tu cuenta");
		this.contraseña = reader.nextLine();
		
		this.liga = nombreliga;
	}

	public void verOnce () throws ExcepcionListaVacia
	{
		if (once [0] == null)
		{
			throw new ExcepcionListaVacia ();
		}
		else
		{
			imprimirEquipo();
		}
	}
	
	public void crearOnce (Club clubactual)
	{
		Scanner reader = new Scanner (System.in);
		
		//El usuario elige 1 portero titular
		boolean exito1 = false;
		boolean exito2 = false;
		boolean exito3 = false;
		boolean exito4 = false;
		do
		{
			System.out.println("Elige un portero");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Portero"))
				{
					equipo.get(i).imprimirDatos();
				}
			}
			int eleccion0 = reader.nextInt();
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).codigo == eleccion0)
				{
					once [0] = equipo.get(i);
					exito1 = true;
				}
			}
			if (exito1 == false)
			{
				System.out.println("Has introducido un código erróneo");
			}
		}
		while (exito1 == false);
		exito1 = false;
		
		//El usuario elige 4 defensas titulares
		do
		{
			System.out.println("Elige cuatro defensas");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Defensa"))
				{
					equipo.get(i).imprimirDatos();
				}
			}
			int eleccion1 = reader.nextInt();
			int eleccion2 = reader.nextInt();
			int eleccion3 = reader.nextInt();
			int eleccion4 = reader.nextInt();
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).codigo == eleccion1)
				{
					once [1] = equipo.get(i);
					exito1 = true;
				}
				if (equipo.get(i).codigo == eleccion2)
				{
					once [2] = equipo.get(i);
					exito2 = true;
				}
				if (equipo.get(i).codigo == eleccion3)
				{
					once [3] = equipo.get(i);
					exito3 = true;
				}
				if (equipo.get(i).codigo == eleccion4)
				{
					once [4] = equipo.get(i);
					exito4 = true;
				}
			}
			if (exito1 == false || exito2 == false || exito3 == false || exito4 == false)
			{
				System.out.println("Has introducido un código erróneo");
			}
		}
		while (exito1 == false || exito2 == false || exito3 == false || exito4 == false);
		exito1 = false;
		exito2 = false;
		exito3 = false;
		
		//El usuario elige 3 centrocampistas titulares
		do
		{
			System.out.println("Elige tres centrocampistas");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Centrocampista"))
				{
					equipo.get(i).imprimirDatos();
				}
			}
			int eleccion5 = reader.nextInt();
			int eleccion6 = reader.nextInt();
			int eleccion7 = reader.nextInt();
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).codigo == eleccion5)
				{
					once [5] = equipo.get(i);
					exito1 = true;
				}
				if (equipo.get(i).codigo == eleccion6)
				{
					once [6] = equipo.get(i);
					exito2 = true;
				}
				if (equipo.get(i).codigo == eleccion7)
				{
					once [7] = equipo.get(i);
					exito3 = true;
				}
			}
			if (exito1 == false || exito2 == false || exito3 == false)
			{
				System.out.println("Has introducido un código erróneo");
			}
		}
		while (exito1 == false || exito2 == false || exito3 == false);
		exito1 = false;
		exito2 = false;
		exito3 = false;
		
		//El usuario elige 3 delanteros titulares
		do
		{
			System.out.println("Elige tres delanteros");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Delantero"))
				{
					equipo.get(i).imprimirDatos();
				}
			}
			int eleccion8 = reader.nextInt();
			int eleccion9 = reader.nextInt();
			int eleccion10 = reader.nextInt();
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).codigo == eleccion8)
				{
					once [8] = equipo.get(i);
					exito1 = true;
				}
				if (equipo.get(i).codigo == eleccion9)
				{
					once [9] = equipo.get(i);
					exito2 = true;
				}
				if (equipo.get(i).codigo == eleccion10)
				{
					once [10] = equipo.get(i);
					exito3 = true;
				}
			}
			if (exito1 == false || exito2 == false || exito3 == false)
			{
				System.out.println("Has introducido un código erróneo");
			}
		}
		while (exito1 == false || exito2 == false || exito3 == false);
		try
		{
			clubactual.verOnce ();
		}
		catch (ExcepcionListaVacia e)
		{
			e.printStackTrace();
			e.getMessage();
		}
	}

	public void añadirJugador(Jugador fichado)
	{
		equipo.add(fichado);
		presupuesto = presupuesto - fichado.precio;
	}
	
	public void borrarJugador(Jugador vendido)
	{
		equipo.remove(vendido);
		presupuesto = presupuesto + vendido.precio;
	}
	
	public void imprimirEquipo ()
	{
		if (equipo.size() == 0)
		{
			System.out.println("No hay jugadores en tu club");
		}
		else
		{
			System.out.println("TU CLUB" + "\n");
			System.out.println("PORTEROS");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Portero"))
				{
					System.out.println(equipo.get(i).codigo + " " + equipo.get(i).nombre + " " + equipo.get(i).apellido + " " + equipo.get(i).equipo + " " + equipo.get(i).posicion);
				}
			}
			System.out.println("\n" + "DEFENSAS");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Defensa"))
				{
					System.out.println(equipo.get(i).codigo + " " + equipo.get(i).nombre + " " + equipo.get(i).apellido + " " + equipo.get(i).equipo + " " + equipo.get(i).posicion);
				}
			}
			System.out.println("\n" + "CENTROCAMPISTAS");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Centrocampista"))
				{
					System.out.println(equipo.get(i).codigo + " " + equipo.get(i).nombre + " " + equipo.get(i).apellido + " " + equipo.get(i).equipo + " " + equipo.get(i).posicion);
				}
			}
			System.out.println("\n" + "DELANTEROS");
			for (int i = 0; i < equipo.size(); i++)
			{
				if (equipo.get(i).posicion.equals("Delantero"))
				{
					System.out.println(equipo.get(i).codigo + " " + equipo.get(i).nombre + " " + equipo.get(i).apellido + " " + equipo.get(i).equipo + " " + equipo.get(i).posicion);
				}
			}
		}
	}
	
	public int obtenerPuntuacion ()
	{
		puntosonce = 0;
		for (int i = 0; i < once.length; i++)
		{
			puntosonce = puntosonce + once [i].getPuntuacion();
		}
		return puntosonce;
	}
}
