import java.time.LocalDate
 import java.time.LocalDateTime
 import java.time.format.DateTimeFormatter
 import java.time.temporal.ChronoUnit
 import java.util.Locale
 fun main() {
 
     do {
         var decision = 0
         println("\tBIENVENIDO\n")
         println("Seleccione una opcion:\n")
         println("1.- Suma tres digitos")
         println("2.- introduce nombre")
         println("3.- calculo de la edad\n")
         println("4.- SALIR\n")
         println("Opcion:")
         decision = readLine()!!.toInt()
         when (decision) {
             1 -> suma()
             2 -> nombre()
             3 -> calculoFecha()
             else -> println("Gracias por usar el programa :)")
         }
         println("Desea repetir el programa?[S|N]?")
 var respuesta = readln()!!.uppercase()
 
     }while(respuesta == "S")
         println("Vuelve pronto")
 
 }
     fun suma(){
         println("Ingrese el 1er valor: ")
         var num1 = readLine()!!.toInt()
         println("Ingrese el 2do valor: ")
         var num2 = readLine()!!.toInt()
         println("Ingrese el 3er valor: ")
         var num3 = readLine()!!.toInt()
         val result = num1 + num2 + num3
         println("El resultado de la suma es: $result\n")
     }
     fun nombre(){
         println("Ingrese su nombre completo: ")
         var nomb = readLine()!!
         println("El nombre es: $nomb ")
     }
 fun calculoFecha() {
     print("Introduce tu fecha de nacimiento (dd/MM/yyyy): ")
     val input = readln()  
 
     val formatter = DateTimeFormatter.ofPattern("dd/MM/yyyy")
     val fechaNac = LocalDate.parse(input, formatter)
     val fechaActual = LocalDate.now()
 
     val meses = ChronoUnit.MONTHS.between(fechaNac, fechaActual)
     val semanas = ChronoUnit.WEEKS.between(fechaNac, fechaActual)
     val dias = ChronoUnit.DAYS.between(fechaNac, fechaActual)
 
     val fechaNacTiempo = fechaNac.atStartOfDay()
     val fechaActualTiempo = LocalDateTime.now()
 
     val horas = ChronoUnit.HOURS.between(fechaNacTiempo, fechaActualTiempo)
     val minutos = ChronoUnit.MINUTES.between(fechaNacTiempo, fechaActualTiempo)
     val segundos = ChronoUnit.SECONDS.between(fechaNacTiempo, fechaActualTiempo)
 
 
 
     println("- Meses: $meses")
     println("- Semanas: $semanas")
     println("- Días: $dias")
     println("- Horas: $horas")
     println("- Minutos: $minutos")
     println("- Segundos: $segundos")
 }
