package Clases;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.Date;

import Excepciones.ExcepcionContraseña;
import Excepciones.ExcepcionListaVacia;

public class Main
{
	protected static ArrayList <Liga> ligas = new ArrayList <Liga> ();
	protected static long tiempoinicial;
	
	public static void main (String []args)
	{
		//Al ejecutar el programa, creamos un Jugador para cada jugador existente en la base de datos, con los atributos que se especifíquen en este
		//Proporcionamos la ruta al documento y generamos un File
		String nombrefichero = "C://Users/Alumno/Desktop/Urbistondo/Proyectos/Fantasy League/Jugadores.csv";
		File archivo = new File (nombrefichero);
		try
		{
			Scanner lector = new Scanner (archivo); //Leemos el documento línea por línea
			lector.next(); //Ignora la primera línea
			//Mientras exista una línea metemos la línea leída en un String, y dividimos ese String en columnas
			//y almacenamos esos pedazos del String original en un array de Strings e imprimimos
			while (lector.hasNext())
			{
				String data = lector.next();
				String [] values = data.split(";");
				{
					if (values [4].equals("Portero"))
					{
						Mercado.jugadores.add(new Portero (data));
					}
					else if (values [4].equals("Defensa"))
					{
						Mercado.jugadores.add(new Defensa (data));
					}
					else if (values [4].equals("Centrocampista"))
					{
						Mercado.jugadores.add(new Centrocampista (data));
					}
					else if (values [4].equals("Delantero"))
					{
						Mercado.jugadores.add(new Delantero (data));
					}
				}
			}
			lector.close();
		}
		catch (FileNotFoundException e)
		{
			e.printStackTrace();
		}

		//Damos la bienvenida al usuario y creamos el mercado de jugadores transferibles
		Date reloj = new Date();
		tiempoinicial = reloj.getTime ();
		Mercado m = new Mercado ();
		Club clubactual = null;
		boolean exito = false;
		System.out.println("\n" + "¡Bienvenido al Liga BBVA Fantasy League 2013 - 2014!");
		int seleccion;
		do
		{
			System.out.println("\n" + "1.- Sign-in" + "\n" + "2.- Log-in");
			Scanner reader = new Scanner (System.in);
			seleccion = reader.nextInt();
			switch (seleccion)
			{
				//Sign-in
				case 1:
				{
						//El usuario elige si desea unirse a una liga existente o si prefiere crear una liga nueva
						System.out.println("Primero debes elegir una liga a la que unirte, o crear una nueva");
						do
						{
							System.out.println("\n" + "1.- Unirse a liga existente" + "\n" + "2.- Crear liga nueva");
							int decision = reader.nextInt();
							int eleccionliga;
							switch (decision)
							{
								//El usuario elige unirse a una liga ya existente
								case 1:
								{
									if (ligas.size() > 0)
									{
										System.out.println("Elige la liga a la que quieres unirte");
										for (int i = 0; i < ligas.size(); i++)
										{
											System.out.println((i + 1) + ".- " + ligas.get(i).nombre);
										}
										Scanner reader4 = new Scanner (System.in);
										eleccionliga = reader4.nextInt();
										System.out.println("Introduce la contraseña de la liga");
										Scanner reader5 = new Scanner (System.in);
										String contraseña = reader5.nextLine();
										if (ligas.get(eleccionliga - 1).contraseña.equals(contraseña))
										{
											//Creamos un club nuevo y lo añadimos a la lista de clubes de la liga y al total de clubes creados
											System.out.println("\n" + "¡A continuación vamos a crear tu nuevo club!");
											ligas.get(eleccionliga - 1).clubes.add(new Club (m, ligas.get(eleccionliga - 1).nombre));
											Liga.totalclubes.add((ligas.get(eleccionliga - 1).clubes.get(ligas.get(eleccionliga - 1).clubes.size() - 1)));
											
											m.fichajesIniciales(ligas.get(eleccionliga - 1).clubes.get(ligas.get(eleccionliga - 1).clubes.size() - 1));
											
											System.out.println("¡Enhorabuena, has fundado tu club, el " + (ligas.get(eleccionliga - 1).clubes.get(ligas.get(eleccionliga - 1).clubes.size() - 1)).nombre + "!");
											clubactual = ligas.get(eleccionliga - 1).clubes.get(ligas.get(eleccionliga - 1).clubes.size() - 1);
											clubactual.imprimirEquipo();
											exito = true;
										}
									}
									else
									{
										System.out.println("No existen ligas. Por favor, crea una liga nueva");
									}
									break;
								}
								
								//El usuario elige crear una nueva liga
								case 2:
								{
									//Creamos una liga nueva y lo añadimos a la lista de ligas existentes
									ligas.add(new Liga ());
									//Creamos un club nuevo y lo añadimos a la lista de clubes de la liga y a la lista total de clubes
									System.out.println("\n" + "¡A continuación vamos a crear tu nuevo club!");
									ligas.get(ligas.size() - 1).clubes.add(new Club (m, ligas.get(ligas.size() - 1).nombre));
									Liga.totalclubes.add((ligas.get(ligas.size() - 1).clubes.get(ligas.get(ligas.size() - 1).clubes.size() - 1)));
									
									m.fichajesIniciales(ligas.get(ligas.size() - 1).clubes.get(ligas.get(ligas.size() - 1).clubes.size() - 1));
									
									System.out.println("¡Enhorabuena, has fundado tu club, el " + (ligas.get(ligas.size() - 1).clubes.get(ligas.get(ligas.size() - 1).clubes.size() - 1)).nombre + "!");
									clubactual = ligas.get(ligas.size() - 1).clubes.get(ligas.get(ligas.size() - 1).clubes.size() - 1);
									clubactual.imprimirEquipo();
									exito = true;
									break;
								}
							}
						}
						while (exito == false);
				}
				
				//Log-in
				case 2:
				{
					if (seleccion == 2)
					{
						if (Liga.totalclubes.size() > 0)
						{
							exito = false;
							System.out.println("Indica cual es tu equipo");
							for (int i = 0; i < Liga.totalclubes.size(); i++)
							{
								System.out.println((i + 1) + ".- " + Liga.totalclubes.get(i).nombre);
							}
							int clubelegido = reader.nextInt();
							if (clubelegido <= Liga.totalclubes.size())
							{
								System.out.println("Introduce la contraseña");
								Scanner reader5 = new Scanner (System.in);
								String contraseña = reader5.nextLine();
								if (Liga.totalclubes.get(clubelegido - 1).contraseña.equals(contraseña))
								{
									System.out.println("Contraseña correcta");
									clubactual = Liga.totalclubes.get(clubelegido - 1);
									exito = true;
								}
								else
								{
									System.out.println("La contraseña no es correcta");
								}
							}
							else
							{
								System.out.println("Elección errónea");
							}
						}
						else
						{
							System.out.println("No existen clubes. Por favor, crea uno nuevo");
						}
					}
					//Menu principal del programa
					if (exito == true)
					{
						int eleccion;
						do
						{
							System.out.println("\n" + "¿Qué deseas hacer?");
							System.out.println("1.- Crear una liga nueva" + "\n" + "2.- Gestionar mi club" + "\n" + "3.- Ver rankings de la temporada" + "\n" + "4.- Cerrar sesión");
							eleccion = reader.nextInt();
							//Ejecutamos código en función de la elección del usuario
							switch (eleccion)
							{
								case 1:
								{
									ligas.add(new Liga ());
									break;
								}
								
								case 2:
								{
									//El usuario elige que desea hacer
									System.out.println("\n" + "¿Qué deseas hacer?");
									System.out.println("\n" + "1.- Once titular" + "\n" + "2.- Mercado" + "\n" + "3.- Borrar club");
									int eleccion2 = reader.nextInt();
									switch (eleccion2)
									{
										case 1:
										{
											System.out.println("\n" + "1.- Ver once titular" + "\n" + "2.- Modificar once titular");
											int eleccion3 = reader.nextInt();
											switch (eleccion3)
											{
												case 1:
												{
													try
													{
														clubactual.verOnce();
													}
													catch (ExcepcionListaVacia e)
													{
														e.getMessage();
														e.printStackTrace();
													}
													break;
												}
												
												case 2:
												{
													//Creamos un once
													clubactual.crearOnce(clubactual);
													break;
												}
											}
											break;
										}
										
										case 2:
										{
											//El usuario elige que desea hacer
											System.out.println("\n" + "1.- Ver mercado" + "\n" + "2.- Fichar" + "\n" + "3.- Vender");
											int eleccion21 = reader.nextInt();
											switch (eleccion21)
											{
												case 1:
												{
													//Imprimimos la lista de jugadores transferibles
													m.imprimirMercado();
													System.out.println("Introduce el código de un jugador del que desees ver la información completa");
													String salir;
													do
													{
														int eleccionjugador = reader.nextInt();
														m.verJugador(eleccionjugador);
														System.out.println("¿Deseas ver más jugadores?");
														salir = reader.nextLine();
													}
													while (salir.equals("SI") || salir.equals("Si") || salir.equals("si"));
													break;
												}
												
												case 2:
												{
													//Imprimimos la lista de jugadores
													String seguir = "Si";
													m.imprimirMercado();
													do
													{
														//Informamos al usuario del presupuesto disponible para fichajes. Ficha a un jugador y le preguntamos si desea fichar de nuevo
														System.out.println("\n" + "Tienes " + (clubactual.presupuesto) + " euros de presupuesto");
														m.ficharJugador(clubactual);
														System.out.println("¿Deseas hacer más fichajes?");
														Scanner reader2 = new Scanner (System.in);
														seguir = reader2.nextLine();
													}
													while (seguir.equals("Si")||(seguir.equals("si"))||(seguir.equals("SI")));
													break;
												}
												
												case 3:
												{
													//Imprimimos la lista de jugadores
													String seguir = "Si";
													do
													{
														//Informamos al usuario del presupuesto disponible para fichajes. Vende a un jugador y le preguntamos si desea vender de nuevo
														System.out.println("\n" + "Tienes " + (clubactual.presupuesto) + " euros de presupuesto");
														m.venderJugador(clubactual);
														System.out.println("¿Deseas vender más jugadores?");
														Scanner reader2 = new Scanner (System.in);
														seguir = reader2.nextLine();
													}
													while (seguir.equals("Si")||(seguir.equals("si"))||(seguir.equals("SI")));
													break;
												}
											}
											break;
										}
										
										case 3:
										{
											System.out.println("¿Estás seguro de que deseas borrar tu club?");
											Scanner reader7 = new Scanner (System.in);
											String decision = reader7.nextLine();
											if (decision.equals("Si")||decision.equals("si")||decision.equals("SI"))
											{
												for (int i = 0; i < Liga.totalclubes.size(); i++)
												{
													if (Liga.totalclubes.get(i).nombre.equals(clubactual.nombre))
													{
														Liga.totalclubes.remove(i);
													}
													for (int j = 0; j < ligas.get(i).clubes.size(); j++)
													{
														if (ligas.get(i).clubes.get(j).nombre.equals(clubactual.nombre))
														{
															ligas.get(i).clubes.remove(j);
														}
													}
												}
												System.out.println("Club borrado");
												eleccion = 4;
											}
											break;
										}
									}
									break;
								}
								
								case 3:
								{
									//No se puede ejecutar este código si no existe ningún club previamente
									System.out.println("Indica la liga de la que quieres ver el ranking");
									Liga.verLiga();
									int eleccionliga = reader.nextInt();
									try
									{
										Liga.verEquiposLiga (eleccionliga);
									}
									catch (ExcepcionListaVacia e)
									{
										e.getMessage();
										e.printStackTrace();
									}
									break;
								}
							}
						}
						while (eleccion != 4);
					}
					break;
				}
			}
		}
		while (seleccion != 3);
	}
}
