import jdk.internal.util.xml.impl.Input;

import javax.swing.*;
import java.util.ArrayList;
import java.util.InputMismatchException;
import java.util.Scanner;

class ToyCar{

    // Declaring static variables
    private String modelCode;
    private double price;
    private int quantity;
    private final double twoPercent = 0.02;

    // Constructor
    public ToyCar (String modelCode, double price, int quantity){
        this.modelCode = modelCode;
        this.price = price;
        this.quantity = quantity;
    }

    // Accessor/get methods
    public String getModelCode(){
        return modelCode;
    }

    public int getQuantity(){
        return quantity;
    }

    public double getPrice(){
        return price;
    }

    // Modifier/set methods

    // Calculating total inventory worth
    public double totalInventoryWorth(){
        return price * quantity;
    }

    // Calculating Insurance cost
    public double insuranceCost(){
        return totalInventoryWorth() * twoPercent;
    }

    @Override
    public String toString(){
        return  "Toy car" +
                "\nModel Code: "+ modelCode +
                "\nPrice: $" + price +
                "\nTotal number of units available: " + quantity +
                "\nTotal inventory worth: $" + totalInventoryWorth()+
                "\nInsurance cost: $" + insuranceCost();
    }
}

class ToyCarElect extends ToyCar {

    // Declaring static variables
    private double batteryDuration;
    private double chargeDuration;
    private final double tenPercent = 0.1;

    // Constructor
    public ToyCarElect(String modelCode, double price, int quantity, double batteryDuration, double chargeDuration) {
        super(modelCode, price, quantity);
        this.batteryDuration = batteryDuration;
        this.chargeDuration = chargeDuration;
    }

    // Accessor/get methods
    public double getBatteryDuration(){
        return batteryDuration;
    }

    // Modifier/set methods

    // Calculating Insurance cost
    @Override
    public double insuranceCost() {
        return totalInventoryWorth() * tenPercent;
    }

    // Displaying information
    @Override
    public String toString(){

        if (batteryDuration%2 != 0 || chargeDuration%2 !=0) {
            // Case of decimal number minutes
            return "Electric " +
                    super.toString() +
                    " \nBattery duration: " + batteryDuration +
                    " minutes \nCharging duration: " + chargeDuration + " minutes";
        }

        else {
            // Case of whole minutes
            return "Electric " +
                    super.toString() +
                    " \nBattery duration: " + (int) batteryDuration +
                    " minutes \nCharging duration: " + (int) chargeDuration + " minutes";
        }
    }
}


public class T1_ChuaTianSheng_A2 {

    // ArrayList to hold ToyCar or ToyCarElect items
    private static ArrayList<ToyCar> cars = new ArrayList<>();

    // Scanner variable to take in user input
    private static Scanner input = new Scanner(System.in);

    // Variables to hold user inputs
    private static int choice;
    private static String codeInput;
    private static double priceInput;
    private static int quantityInput;
    private static double batteryInput;
    private static double chargingInput;
    private static String ynInput;
    private static double priceLowerBound;
    private static double priceUpperBound;
    private static double batteryDurationQuery;

    // Boolean variable for validating
    private static boolean check = true;

    // Variable to hold model code's name
    private static String codeSearch = "";

    // Variable to hold the value to an index
    private static int codeIndex = 0;

    // Count variable
    private static int count = 0;

    // Checking model code in the arraysList <ToyCar>
    private static void modelCodeSearch(){
        for (int j = 0; j < cars.size(); j++) {
            if (codeInput.trim().equals(cars.get(j).getModelCode())) {
                codeSearch = cars.get(j).getModelCode();
                codeIndex = j;
                count++;
            }
        }
    }

    // Reset check boolean
    private static void resetCheckBoolean(){
        check = true;
    }

    // Reset counter
    private static void resetCounters(){
        codeSearch = "";
        codeIndex = 0;
        count = 0;
    }

    // Option 1: Adding inventory
    private static void choice1() {

        // Clear input buffer
        input.nextLine();

        // Making sure the input is not empty
        while (check) {
            // Prompt user to input car information
            System.out.print("Model code: ");
            codeInput = input.nextLine();

            // Reset counters
            resetCounters();

            modelCodeSearch();

            if (codeInput.trim().isEmpty())
                System.out.println("Please key in a model code");

            else if (count > 0)
                System.out.println("Model code is already in the system");

            else
                check = false;
        }

        resetCheckBoolean();

        // Checking if the price input is more than 0
        while (check) {
            try {
                System.out.print("Price: ");

                priceInput = input.nextDouble();

                if (priceInput <= 0)
                    System.out.println("Price must be more than 0");
                else
                    check = false;
            }

            // Case of wrong input
            catch (InputMismatchException e) {
                System.out.println("Please input only numbers");
                //Clear input buffer
                input.nextLine();
            }
        }

        resetCheckBoolean();

        // Checking if the quantity input is more than 0
        while (check) {
            try {
                System.out.print("Quantity: ");

                quantityInput = input.nextInt();

                if (quantityInput < 0)
                    System.out.println("Quantity must be not be a negative number");
                else
                    check = false;
            }

            // Case of wrong input
            catch (InputMismatchException e) {
                System.out.println("Please input only numbers");
                //Clear input buffer
                input.nextLine();
            }
        }

        resetCheckBoolean();

        // Clear input buffer
        input.nextLine();

        // Prompting user if the car is electric
        while (check) {

            System.out.print("Is the car a electric car (y/n)? ");

            ynInput = input.nextLine();

            if (ynInput.toLowerCase().trim().equals("y") || ynInput.toLowerCase().trim().equals("n"))
                check = false;
            else
                System.out.println("Please input only y or n");
        }

        resetCheckBoolean();

        // Checking if battery duration is more than 0
        while (check) {
            try {
                // If the car is an electric car, more info is asked for the user to input
                if (ynInput.toLowerCase().trim().equals("y")) {
                    System.out.print("Battery Duration (Minutes): ");
                    batteryInput = input.nextDouble();

                    if (batteryInput <= 0)
                        System.out.println("Battery Duration must be more than 0");
                    else
                        check = false;
                }
                else
                    check = false;
            } catch (InputMismatchException e) {
                System.out.println("Please input only numbers");
                //Clear input buffer
                input.nextLine();
            }
        }

        resetCheckBoolean();

        // Checking if charging duration is more than 0
        while (check) {
            try {
                if (ynInput.toLowerCase().trim().equals("y")) {

                    System.out.print("Charging duration (Minutes): ");
                    chargingInput = input.nextDouble();

                    if (chargingInput <= 0)
                        System.out.println("Charging Duration must be more than 0");
                    else
                        check = false;

                }
                else
                    check = false;
                // Creating and adding electric toy car to array
                cars.add(new ToyCarElect(codeInput, priceInput, quantityInput, batteryInput, chargingInput));
            } catch (InputMismatchException e) {
                System.out.println("Please input only numbers");
                //Clear input buffer
                input.nextLine();
            }
        }

            if (ynInput.toLowerCase().trim().equals("n")) {
                // Creating and adding toy car to array
                cars.add(new ToyCar(codeInput, priceInput, quantityInput));
            }
            resetCheckBoolean();
        }

    // Option 2: Removing inventory
    private static void choice2(){

        // Clear input buffer
        input.nextLine();

        // Checking model name and quantity
        while (check){
            System.out.print("Input model code to be removed: ");
            codeInput = input.nextLine();

            resetCounters();
            modelCodeSearch();

            if (codeSearch.isEmpty())
                System.out.println("Model code does not exist in the system");
            else if (cars.get(codeIndex).getQuantity() > 0)
                System.out.println("Model's quantity is not empty");
            else {
                cars.remove(codeIndex);
                check = false;
            }
        }
        resetCheckBoolean();
    }

    // Option 3: Show all inventory
    private static void choice3(){
        for (int j = 0; j < cars.size(); j++)
            System.out.println("\n"+cars.get(j));
    }

    // Option 4: Search inventory by car model
    private static void choice4(){

        // Clear input buffer
        input.nextLine();

        System.out.print("Please input the model code: ");
        codeInput = input.nextLine();

        resetCounters();
        modelCodeSearch();

        if (codeInput.trim().isEmpty())
            System.out.println("Please key in a model code");
        else if (codeSearch.isEmpty())
            System.out.println("Model code does not exist in the system");
        else
            System.out.println("\n" +cars.get(codeIndex));
    }

    // Option 5: Search inventory by car price
    private static void choice5(){
        // Clear input buffer
        input.nextLine();

        // Reset counter
        resetCounters();

        while (check) {
            try {
                System.out.print("Please input lower bound price: ");
                priceLowerBound = input.nextDouble();

                System.out.print("Please input upper bound price: ");
                priceUpperBound = input.nextDouble();

                check = false;

                //Search and display if price found within range
                for (int i = 0; i < cars.size(); i++) {
                    if (cars.get(i).getPrice() >= priceLowerBound && cars.get(i).getPrice() <= priceUpperBound) {
                        System.out.println("\n" + cars.get(i));
                        count++;
                    }
                }

                if (count == 0)
                    System.out.println("\nNo model(s) found within given range");
            }

            // Case of wrong input
            catch (InputMismatchException e) {
                System.out.println("Input only numbers");
                // Clear input buffer
                input.nextLine();
            }
        }
    }

    // Option 6: Search inventory by battery duration
    private static void choice6(){

        // Clear input buffer
        input.nextLine();

        // Reset counter
        resetCounters();

        System.out.print("Please input battery duration: ");
        batteryDurationQuery = input.nextDouble();

        for (int i = 0; i < cars.size(); i++){
            if (cars.get(i) instanceof  ToyCarElect) {
                if (((ToyCarElect) cars.get(i)).getBatteryDuration() >= batteryDurationQuery) {
                    System.out.println("\n" + cars.get(i));
                    count++;
                }
            }
        }

        if (count == 0)
            System.out.println("\nNo model(s) found within given range");
    }

    public static void main(String[] args) {

        // do loop until user key in 7
        do {

            try {
                System.out.println("Mini-inventory management software: ");

                // Displaying 7 choices for user to chose from
                System.out.println("1 Add inventory");
                System.out.println("2 Remove inventory");
                System.out.println("3 Show all inventory");
                System.out.println("4 Search inventory by car model");
                System.out.println("5 Search inventory by car price");
                System.out.println("6 Search inventory by car battery duration");
                System.out.println("7 Quit");
                System.out.print("Your choice?: ");
                choice = input.nextInt();

                if (choice > 7)
                    System.out.println("Please input numbers from 1-7 only\n");

            }
            catch (InputMismatchException e){
                System.out.println("Please input only numbers");
                input.nextLine();
            }

            switch (choice){
                case 1:
                    choice1();
                    break;
                case 2:
                    choice2();
                    break;
                case 3:
                    choice3();
                    break;
                case 4:
                    choice4();
                    break;
                case 5:
                    choice5();
                    break;
                case 6:
                    choice6();
            }
            System.out.println(" ");
        } while (choice != 7);
    }
}

