import java.util.ArrayList;
import java.util.Scanner;

class TestResult{

    // Declaring static variables
    private String applicantID;
    private String name;
    private int test1;
    private int test2;

    // Constructor
    public TestResult (String applicantID, String name, int test1, int test2){
        this.applicantID = applicantID;
        this.name = name;
        this.test1 = test1;
        this.test2 = test2;
    }

    // Accessor methods
    public String getApplicantID(){
        return applicantID;
    }

    public String getName(){
        return name;
    }

    public int getTest1(){
        return test1;
    }

    public int getTest2(){
        return test2;
    }

    // Mutator methods
    public void setApplicantID(String applicantID) {
        this.applicantID = applicantID;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setTest1(int test1) {
        this.test1 = test1;
    }

    public void setTest2(int test2) {
        this.test2 = test2;
    }

    // Computing overall score method
    public int getOverallScore(){
        return (int)((test1 * 0.4) + (test2 * 0.6));
    }

    // Getting the overall grade method
    public String getGrade(){
        if (getOverallScore() >= 70)
            return "Good";
        else if (getOverallScore() >= 50)
            return "Pass";
        else
            return "Fail";
    }

    // Comparing two instances of TestResult method
    public boolean comparingID(TestResult id) {
        return applicantID.equals(id.getApplicantID());
    }

    // Instance method
    public String toString(){
        return "\nApplicant ID: "+ applicantID + "\nName\t\t: " + name + "\nTest 1 score: "+ test1 + "\nTest 2 score: " + test2;
    }

}

public class T1_ChuaTianSheng_A1 {
    public static void main(String[] args) {

        // Creating scanner to take in user inputs
        Scanner input = new Scanner(System.in);

        // Creating ArrayList to store TestResult objects
        ArrayList<TestResult> tArray = new ArrayList<>();

        // Variables to hold user's inputs
        String id;
        String name;
        int test;
        int tests;

        // Do loop to prompt user to input details and store them into the ArrayList
        do {
            System.out.printf("%s", "Candidate ID: ");
            id = input.nextLine();

            System.out.printf("%-12s%s", "Name", ": ");
            name = input.nextLine();

            System.out.printf("%-12s%s", "Test 1 score", ": ");
            test = input.nextInt();

            System.out.printf("%-12s%s", "Test 2 score", ": ");
            tests = input.nextInt();

            input.nextLine(); // Clear input buffer

            tArray.add(new TestResult(id, name, test, tests));

            System.out.print("Enter another record? (y/n) ");
        }
        while (input.nextLine().equals("y"));

        // Variable to count the number of matching data
        int count = 0;
        int biggestOverall = 0;
        int choice;

        // While loop to repeat the options until user input 6
        while (true) {
            // Displaying a list of options for user to chose from
            System.out.println("\n1 Search test result by applicant Id");
            System.out.println("2 Search test result(s) by applicant name");
            System.out.println("3 Search test result(s) by overall score");
            System.out.println("4 Show test result(s) with highest overall score");
            System.out.println("5 Show failure list");
            System.out.println("6 Quit");
            System.out.print("Please choose an option: ");
            choice = input.nextInt();

            // Switch to respond base on user's choice
            switch (choice) {
                case 1:
                    System.out.print("Enter applicant Id: ");
                    input.nextLine(); // clear input buffer
                    id = input.nextLine();
                    //search and display the corresponding test result
                    for (int i = 0; i < tArray.size(); ++i) {
                        if (id.equals(tArray.get(i).getApplicantID())) {
                            System.out.println(tArray.get(i));
                            count++;
                        }
                    }
                    if (count == 0) {
                        System.out.println("\nNo applicant Id found");
                    }
                    count = 0;
                    break;
                case 2:
                    System.out.print("Enter applicant name: ");
                    input.nextLine(); // clear input buffer
                    name = input.nextLine();
                    //search and display the corresponding test result
                    for (int i = 0; i < tArray.size(); ++i) {
                        if (name.equals(tArray.get(i).getName())) {
                            System.out.println(tArray.get(i));
                            count++;
                        }
                    }
                    if (count == 0) {
                        System.out.println("\nNo applicant name found");
                    }
                    count = 0;
                    break;
                case 3:
                    System.out.print("Enter the lower bound score : ");
                    test = input.nextInt();
                    System.out.print("Enter the upper bound score: ");
                    tests = input.nextInt();

                    //search and display the corresponding test result
                    for (int i = 0; i < tArray.size(); ++i) {
                        if (tArray.get(i).getOverallScore() >= test && tArray.get(i).getOverallScore() <= tests) {
                            System.out.println(tArray.get(i));
                            System.out.println("Overall score: "+ tArray.get(i).getOverallScore());
                            count++;
                        }
                    }
                    if (count == 0) {
                        System.out.println("\nNo overall score found between given range");
                    }
                    count = 0;
                    break;
                case 4:
                    //search and display the corresponding test result
                    for (int i = 0; i < tArray.size(); ++i) {
                        if (biggestOverall < tArray.get(i).getOverallScore())
                            biggestOverall = tArray.get(i).getOverallScore();
                    }
                    for (int i = 0; i < tArray.size(); ++i) {
                        if (tArray.get(i).getOverallScore() == biggestOverall) {
                            System.out.println(tArray.get(i));
                            System.out.println("Highest overall score: "+ tArray.get(i).getOverallScore());
                        }
                    }
                    break;
                case 5:
                    //search and display the corresponding test result
                    for (int i = 0; i < tArray.size(); ++i) {
                        if (tArray.get(i).getGrade().equals("Fail")) {
                            System.out.println(tArray.get(i));
                            count++;
                        }
                    }
                    if (count == 0) {
                        System.out.println("\nNo applicant failed");
                    }
                    count = 0;
                    break;
            }
            if (choice == 6)
                break;
        }
    }
}
