/*------------------------------------------------------
Name: Chua Tian Sheng
Full Time
Tutorial group: T02F
Student number: 10237482
File Name: ChuaTianSheng_A2.java
Declaration: This is my own work
-------------------------------------------------------*/


import java.io.File;
import java.io.IOException;
import java.util.Scanner;

///////////* Creating Enum for Month *///////////
enum Month {Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec}

            ///////////* Creating class for Date *///////////
class Date{

    // Declaring non-static private variables
    private int day;
    private Month month;
    private int year;

                ///////////* Constructors for Date object *///////////
    // Default constructor
    public Date(){
        this (1, Month.Jan, 2021);
    }

    // Other constructor
    public Date(int day, Month month, int year){
        this.day = day;
        this.month = month;
        this.year = year;
    }

    // Copy constructor
    public Date( Date d){
        day =d.day;
        month = d.month;
        year = d.year;
    }

                ///////////* Accessor methods to get the value of the private variables *///////////

    // Day
    public int getDay(){
        return day;
    }

    // Month
    public Month getMonth(){
        return month;
    }

    // Year
    public int getYear(){
        return year;
    }

                ////* Mutator method to change the value of the private variables */////
    void setDate(int day, Month month, int year){
        this.day = day;
        this.month = month;
        this.year = year;
    }
}

                ///////////* Creating class for HealthProfile *///////////
class HealthProfile{

    // Declaring non-static private variables
    private String firstName;
    private String lastName;
    private Date dob;
    private double height;
    private double weight;
    private int currentYear;

                    ///////////* Constructors for HealthProfile object *///////////

    // Other constructor
    public HealthProfile(String firstName, String lastName, Date dob, double height, double weight, int
                  currentYear){
        this.dob = dob;
        this.firstName = firstName;
        this.lastName = lastName;
        this.height = height;
        this.weight = weight;
        this.currentYear = currentYear;
    }

    // Copy Constructor
    public HealthProfile(HealthProfile hr){
        firstName = hr.firstName;
        lastName = hr.lastName;
        dob = hr.dob;
        height = hr.height;
        weight = hr.weight;
        currentYear = hr.currentYear;
    }


                    ///////////* Accessor methods to get the value of the private variables *///////////

    // First Name
    public String getFirstName(){
        return firstName;
    }

    // Last Name
    public String getLastName(){
        return lastName;
    }

    // Date Of Birth
    public Date getDob(){
        return dob;
    }

    // Height
    public double getHeight(){
        return height;
    }

    // Weight
    public double getWeight(){
        return weight;
    }

    // Current Year
    public int getCurrentYear(){
        return currentYear;
    }

                    ////* Mutator methods to change the value of the private variables */////
    // First Name
    void setFirstName(String firstName){
        this.firstName = firstName;
    }

    // Last Name
    void setLastName(String lastName){
        this.lastName = lastName;
    }

    // Date Of Birth
    void setDob(Date dob){
        this.dob = dob;
    }

    // Current Year
    void setCurrentYear(int currentYear){
        this.currentYear = currentYear;
    }

    // BMI
    void setBMIInfo(double height, double weight){

    }

                    ////* Maths Methods to get what we want */////
    // Getting the Age
    int getAge(){
        int age = currentYear - dob.getYear();
        return age;
    }

    // Getting the Maximum Heart Rate
    int getMaximumHearRate(){
        int maxHeartRate = 220 - getAge();
        return maxHeartRate;
    }

    // Getting the Minimum Target Heart Rate
    double getMinimumTargetHeartRate(){
        double minTarget = (double)getMaximumHearRate()*0.5;
        return minTarget;
    }

    // Getting the Maximum Target Heart Rate
   double getMaximumTargetHeartRate(){
        double maxTarget = (double)getMaximumHearRate()*0.85;
        return maxTarget;
   }

   // Getting the BMI
    double getBMI(){
        double BMI = getWeight()/(getHeight()*getHeight());
        return BMI;
    }


    // Printing Info
    void printInfo(){
        System.out.printf("Name: %s, %s", getFirstName(), getLastName());
        System.out.printf("\nDate of birth: %d %s %d", dob.getDay(), dob.getMonth(), dob.getYear());
        System.out.printf("\nYour weight: %.1f kg", getWeight());
        System.out.printf("\nYour height: %.1f meter", getHeight());
        System.out.printf("\nCurrent year: %d", getCurrentYear());
        System.out.printf("\nYour age: %d years old", getAge());
        System.out.printf("\nClinic analysis, based on your age:");
        System.out.printf("\n\t1. Your maximum heart rate is %d", getMaximumHearRate());
        System.out.printf("\n\t2. Your minimum heard rate is %.2f", getMinimumTargetHeartRate());
        System.out.printf("\n\t3. Your maximum heard rate is %.2f", getMaximumTargetHeartRate());
        System.out.printf("\nYour BMI is %.1f", getBMI());
        System.out.printf("\n\tWeight category              Range");
        System.out.printf("\n\tUnderweight / too low        Below 18.5");
        System.out.printf("\n\tHealthy range                18.5-25");
        System.out.printf("\n\tOverweight                   25-30");
        System.out.printf("\n\tObese                        30-35");
        System.out.printf("\n\tSevere Obesity               35-40");
        System.out.printf("\n\tMorbid Obesity               Over 40");

    }

}


class ChuaTianSheng_A2 {

    public static void main(String[] args) throws IOException {

        //Constructing a Scanner object linked to the data file
        Scanner input = new Scanner(new File ("patient.txt"));

        //Declare variable for 1st patient
        String firstName;
        String lastName;
        int day;
        String month1;
        Month month;
        int year;
        Date dob;
        double height;
        double weight;
        int currentYear;

        //Declare variable for 2nd patient
        String firstName2;
        String lastName2;
        int day2;
        String month2;
        int year2;
        Date dob2;
        double height2;
        double weight2;
        int currentYear2;
        Month month5;

                //* Extract info from the data file for the first patient *//
        // Reading first name
        firstName = input.nextLine();

        // Reading second name
        lastName = input.nextLine();

        // Reading day
        day = input.nextInt();

        // Reading month
        month1 = input.next();

        // Reading year
        year = input.nextInt();

        // Reading height
        height = input.nextDouble();

        // Reading weight
        weight = input.nextDouble();

        // Reading current year
        currentYear = input.nextInt();


        //* Reading the enum *//
        month = Month.valueOf(month1);

        //* Combining the day month and year into dob *//
        dob = new Date(day, month, year);

        // Creates object for first patient
        HealthProfile user = new HealthProfile(firstName, lastName, dob, height, weight, currentYear);

        // Displaying info for first patient
        user.printInfo();

        //Clears the input buffer
        input.nextLine();


                    //* Extract info from the data file for the second patient *//
        // Reading first name
        firstName2 = input.nextLine();

        // Reading last name
        lastName2 = input.nextLine();

        // Reading day
        day2 = input.nextInt();

        // Reading month
        month2 = input.next();

        // Reading year
        year2 = input.nextInt();

        // Reading height
        height2 = input.nextDouble();

        // Reading weight
        weight2 = input.nextDouble();

        // Reading current year
        currentYear2 = input.nextInt();


        //* Reading the enum *//
        month5 = Month.valueOf(month2);

        //* Combining the dob *//
        dob2 = new Date(day2, month5, year2);

        System.out.println("\n");
        // Creates object for second patient
        HealthProfile user2 = new HealthProfile(firstName2, lastName2, dob2, height2, weight2, currentYear2);
        // Displaying info for second patient
        user2.printInfo();


    }
}
