package Clases;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class Delantero extends Jugador
{
	public Delantero (String datos)
	{
		String data = datos;
		String [] values = data.split(";");
		{
			codigo = Integer.parseInt(values[0]);
			nombre = values[1];
			apellido = values[2];
			equipo = values[3];
			posicion = values[4];
			precio = Integer.parseInt(values[5]);
			edad = Integer.parseInt(values[6]);
			goles = Integer.parseInt(values[7]);
			golesencajados = Integer.parseInt(values[8]);
			partidos = Integer.parseInt(values[9]);
			mercado = Boolean.parseBoolean(values[10]);
			amarillas = Integer.parseInt(values[11]);
			rojas = Integer.parseInt(values[12]);
			valoracion = Integer.parseInt(values[13]);
			puntostemporada = Integer.parseInt(values[14]);
			jornada = Integer.parseInt(values[15]);
			lesion = Boolean.parseBoolean(values[16]);
		}
	}
	
	public int calcularPuntuacion ()
	{
		return jornada;
	}
	
	public int getPuntuacion ()
	{
		int puntos = valoracion + (goles * 6) - (amarillas * 1) - (rojas * 6);
		return puntos;
	}
	
	public int getPuntosPartidoJugado ()
	{
		return this.puntostemporada / this.partidos;
	}

	public int getPuntosJornada()
	{
		return 0;
	}

	public void imprimirDatos()
	{
		String injury;
		if (lesion == true)
		{
			injury = "Baja";
		}
		else
		{
			injury = "Alta";
		}
		System.out.println(codigo + " " + nombre + " " + apellido + " " + equipo + " " + posicion + " " + puntostemporada + " " + injury);
	}
}