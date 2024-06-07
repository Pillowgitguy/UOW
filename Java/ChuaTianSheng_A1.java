// Full Name:Chua Tian Sheng
// Full Time
// Tutorial group: T02F
// Student number: 10237482
// Declaration: This is my own work


import java.util.Scanner;

public class ChuaTianSheng_A1 {

    public static void main (String[] args )
    {
        // Creating a Scanner class object to read user inputs
        Scanner input = new Scanner(System.in);

                            ///////////* UPON STARTING THE SYSTEM *///////////

        //Welcome message
        System.out.println("Welcome to iPhone online service \n--------------------------------- \nEnter three iphone to be sold");
        System.out.print ("1.");

        //Read and shows the first user input
        String firstIphone = input.nextLine();

        // Read and shows the second user input
        System.out.print("2.");
        String secondIphone = input.nextLine();

        // Read and shows the third user input
        System.out.print("3.");
        String thirdIphone = input.nextLine();




                            ///////////* DELIVER INFO *///////////

        // System ask user to input deliver info
        System.out.println("\nSome other info \n---------------");
        System.out.print("Deliver address: ");

        // User input deliver info
        String address = input.nextLine();

        // User input Postal code
        System.out.print("Postal code: ");
        String postal = input.nextLine();

        // User input Country
        System.out.print("Country: ");
        String country = input.nextLine();




                             ///////////* TOTAL QUANTITIES AND PRICES *///////////

        //System ask user to input the quantities and prices for the respective iPhones
        System.out.print("\nEnter quantities and price of "+ firstIphone + ": ");

        // User input quantities and cost of first iPhone
        int quantities1 = input.nextInt();
        double cost1 = input.nextDouble();

        // User input quantities and cost of second iPhone
        System.out.print("Enter quantities and price of " + secondIphone + ": ");
        int quantities2 = input.nextInt();
        double cost2 = input.nextDouble();

        // User input quantities and cost of third iPhone
        System.out.print("Enter quantities and price of " + thirdIphone + ": ");
        int quantities3 = input.nextInt();
        double cost3 = input.nextDouble();

        //* Showing the summary table *//
        System.out.println("\nSummary of iPhones \n-----------------");
        System.out.printf("\n%-25s %-15s %-10s \n%s", "iPhone", "Quantity", "Price", "-------------------------------------------------");
        System.out.printf("\n%-25s %-15d %-10.2f", firstIphone, quantities1, cost1);
        System.out.printf("\n%-25s %-15d %-10.2f", secondIphone, quantities2, cost2);
        System.out.printf("\n%-25s %-15d %-10.2f\n\n", thirdIphone, quantities3, cost3);



                            ///////////* SWAPPING INFO OF 1ST TWO IPHONE *///////////

        // Swapping the name of first and second phone
        String swap1 = firstIphone;
        firstIphone = secondIphone;
        secondIphone = swap1;

        // Swapping quantities of first and second phone
        int swap2 = quantities1;
        quantities1 = quantities2;
        quantities2 = swap2;

        // Swapping cost of first and second phone
        double swap3 = cost1;
        cost1 = cost2;
        cost2 = swap3;

        //* New table after the swap *//
        System.out.println("\n\nSummary of iPhones after the swaps \n---------------------------------");
        System.out.printf("\n%-25s %-15s %-10s %s", "iPhone", "Quantity", "Price", "\n--------------------------------------------------");
        System.out.printf("\n%-25s %-15d %-10.2f", firstIphone, quantities1, cost1);
        System.out.printf("\n%-25s %-15d %-10.2f", secondIphone, quantities2, cost2);
        System.out.printf("\n%-25s %-15d %-10.2f\n\n", thirdIphone, quantities3, cost3);



                            ///////////* CUSTOMER PLACE ORDER ONLINE *///////////

        // Ask user to input order of first phone
        System.out.println("\n\nPlace your order \n-----------------");
        System.out.print("No of " + firstIphone + ": ");

        // User input first order
        int firstOrder = input.nextInt();

        // User input second order
        System.out.print("No of " + secondIphone + ": ");
        int secondOrder = input.nextInt();

        // User input third order
        System.out.print("No of " + thirdIphone + ": ");
        int thirdOrder = input.nextInt();

        // Calculate the subtotal
        double onlineCost1 = computeTotal(firstOrder, cost1);
        double onlineCost2 = computeTotal(secondOrder, cost2);
        double onlineCost3 = computeTotal(thirdOrder, cost3);

        // Calculate subtotal
        double subtotal = onlineCost1 + onlineCost2 + onlineCost3;

        // Calculate GST
        double gst = (subtotal*0.07);

        // Calculate Total cost
        double totalCost = (gst + subtotal);

        //* Table of Summary of orders *//
        System.out.println("\nSummary of your order \n---------------------");
        System.out.printf("\n%-25s %-15s %-10s \n%s", "iPhone", "Quantity", "Cost", "-----------------------------------------------------");
        System.out.printf("\n%-25s %-15d %-10.2f", firstIphone, firstOrder, onlineCost1);
        System.out.printf("\n%-25s %-15d %-10.2f", secondIphone, secondOrder, onlineCost2);
        System.out.printf("\n%-25s %-15d %-10.2f %s", thirdIphone, thirdOrder, onlineCost3, "\n-----------------------------------------------------");
        System.out.printf("\n%-41s %-10.2f \n%-41s %-10.2f \n%-41s %-20.2f", "Subtotal:", subtotal, "GST (7%):", gst, "Total Cost:", totalCost);
        System.out.println("\n-----------------------------------------------------");



                            ///////////* BALANCE REPORT *///////////

        // Balance for first iPhone
        int bal1 = quantities1 - firstOrder;

        // Balance for second iPhone
        int bal2 = quantities2 - secondOrder;

        // Balance for third iPhone
        int bal3 = quantities3 - thirdOrder;

        //* Balance report table *//
        System.out.println("\nBalance report \n---------------");
        System.out.printf("%-25s %-10s %-10s %-10s", "iPhone", "Quantity","Sold", "Balance");
        System.out.println("\n-------------------------------------------------------");
        System.out.printf("%-25s %-10d %-10d %-10d", firstIphone, quantities1, firstOrder,bal1);
        System.out.printf("\n%-25s %-10d %-10d %-10d", secondIphone, quantities2, secondOrder, bal2);
        System.out.printf("\n%-25s %-10d %-10d %-10d", thirdIphone, quantities3, thirdOrder,bal3);
        System.out.println("\n-------------------------------------------------------");



    }

    // Method definition for getting the total price
    public static double computeTotal (int a, double b) {
        return a*b;
    }
}
