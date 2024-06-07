/*------------------------------------------------------
Name: Chua Tian Sheng
Full Time
Tutorial group: T02F
Student number: 10237482
File Name: ChuaTianSheng_A3.java
Declaration: This is my own work
-------------------------------------------------------*/

import java.util.*;

class Country{

    // Declaring non-static private variables
    private String name;
    private String player;
    private int age;

    // Default constructor
    public Country(){

    }

    // Other constructor
    public Country(String name, String player, int age){
        this.name = name;
        this.player = player;
        this.age = age;
    }

    // Accessor method to get name
    public String getName(){
        return name;
    }

    // Accessor method to get player
    public String getPlayer(){
        return player;
    }

    // Accessor method to get age
    public int getAge(){
        return age;
    }

    // Mutator method
    public void setInfo(String name, String player, int age){
        this.name = name;
        this.player = player;
        this.age = age;
    }
}

class Diving {

    // Declaring variables
    public static final int[] SIZE = {1, 2, 3, 4, 5};
    private Country name;
    private double[] score;
    private double difficulty;
    private double cf;
    private double fs;

    // Other constructor
    public Diving(Country name, double[] score, double difficulty, double cf) {
        this.name = name;
        this.score = score;
        this.difficulty = difficulty;
        this.cf = cf;
    }

    // Accessor method to get Country
    public Country getCountry() {
        return name;
    }

    // Accessor method to get the Score
    public double[] getScored() {
        return score;
    }

    // Accessor method to get Difficulty
    public double getDifficulty() {
        return difficulty;
    }

    // Accessor method to get Carried Forward
    public double getCarriedForward() {
        return cf;
    }

    // Accessor method to get Final Score
    public double getFinalScore() {
        return fs;
    }

    //Mutator method to change difficulty
    public void setDifficulty(Double difficulty) {
        this.difficulty = difficulty;
    }

    // Mutator method to change the carried forward
    public void setCf(double cf) {
        this.cf = cf;
    }

    // Method to get Sorted List
    private ArrayList<Double> getSortedList() {
        ArrayList<Double> sortedList = new ArrayList<Double>();
        for(double d : getScored())
            sortedList.add(d);
        Collections.sort(sortedList);
        return sortedList;
    }

    // Method to get the highest score
    private double highest(){
        return getSortedList().get(6);
    }

    // Method to get second highest
    private double secondHighest(){
        return getSortedList().get(5);
    }

    // Method to get the lowest score
    private double lowest(){
        return getSortedList().get(0);
    }

    // Method to get second lowest
    private double secondLowest(){
        return getSortedList().get(1);
    }

    // Method to get the final score
    public double finalScore(){
        double total = 0.0;
      for (int j = 0; j < 7; j++) {
            total = total + getSortedList().get(j);
        }
        total -= (highest() + secondHighest() + lowest() + secondLowest());
        total *= getDifficulty();
        return total;
    }

    // Method to get the total Score
    public double getTotalScore(){
         return getCarriedForward() + finalScore();
    }

    // Printing info of each score
    public void printInfo(){
        for ( int l =0; l < 7; l++) {
            System.out.printf("%-10.1f", getScored()[l]);
        }
        System.out.printf("%-6s", " ");
    }
}

public class ChuaTianSheng_A3 {

    // Declaring variable
    private final String[] Countries = {"China 2", "Thailand", "China 1", "South Korea", "Japan", "USA", "Australia", "Malaysia", "Russia", "Brazil"};

    // Getting randomized 7 score
    static void getScore(double[] score) {
        int[] fixedScores = {5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100};
        Random random = new Random();
        double sco;
        for (int i = 0; i < 7; i++) {
            int randomIndex = random.nextInt(fixedScores.length);
            sco = (double) fixedScores[randomIndex] / 10;
            score[i] = sco;
        }
    }

    // Sorting the result of in descending order and print the result
    private static void displaySortedList(ArrayList<Diving> aList) {
        System.out.println("\nThe result is");
        for ( int p =0; p < 9; p++) {
            for (int q = 0; q < 9; q++) {
                if (aList.get(q).getCarriedForward() > aList.get(q + 1).getCarriedForward())
                    Collections.swap(aList, q, q+1);
            }
        }
        int p = 0;
        for ( int l = 9; l > -1; l--)
        System.out.printf("%-4d %-15s %.2f\n", ++p, (aList.get(l).getCountry().getName()), (aList.get(l).getCarriedForward()));
    }

    // Method to generate degree of difficulty, 2-5
    private static double getDifficulty() {
        double rand = new Random().nextDouble();
        double random = 2.0 + (rand * (5.0 - 2.0));
        double result = (double) Math.round(random * 10) / 10;
        return result;
    }

    // Method to generate age, 15 - 30
    private static int getAge() {
        Random ran = new Random();
        int y = ran.nextInt(16) + 15;
        return y;
    }

    // Printing the Country and difficulty info
    private static void displayGameInfo(ArrayList<Diving> aList) {
        System.out.printf("%-15s %-10s %-8s %-10s\n", "County", "Diver", "Age", "Difficulty" );

        for ( int l = 0; l < 10; l++) {
            System.out.printf("%-15s %-10s %-15d %-10.1f\n", (aList.get(l).getCountry().getName()), (aList.get(l).getCountry().getPlayer()), (aList.get(l).getCountry().getAge()), (aList.get(l).getDifficulty()));
        }
        System.out.println(" ");
    }

    // Printing the result of each round
    private static void displayResultInfo(ArrayList<Diving> aList) {
        System.out.printf("%-15s %-9s %-9s %-9s %-9s %-9s %-9s %-8s %-16s %-8s %-10s %-10s\n"
                ,"Countries", "J1", "J2", "J3", "J4", "J5", "J6", "J7", "Difficulty", "c/f", "Current", "Total");

        for ( int l =0; l < 10; l++) {
            System.out.printf("%-16s", (aList.get(l).getCountry().getName()));
            aList.get(l).printInfo();
            System.out.printf("%-10.1f", aList.get(l).getDifficulty());
            System.out.printf("%-10.2f", aList.get(l).getCarriedForward());
            System.out.printf("%-10.2f", aList.get(l).finalScore());
            System.out.printf("%-10.2f", aList.get(l).getTotalScore());
            System.out.println(" ");
        }
    }

    // Updating the carried forward score after each round
    public static void updateCFArray(ArrayList<Diving> aList) {
        for ( int l =0; l < 10; l++) {
            aList.get(l).setCf(aList.get(l).getTotalScore());
        }
    }

    public static void main(String[] args) {

        ChuaTianSheng_A3 Countr = new ChuaTianSheng_A3();

        // Creating 10 object for Country class
        Country player1 = new Country(Countr.Countries[0], "Name1", getAge());
        Country player2 = new Country(Countr.Countries[1], "Name2", getAge());
        Country player3 = new Country(Countr.Countries[2], "Name3", getAge());
        Country player4 = new Country(Countr.Countries[3], "Name4", getAge());
        Country player5 = new Country(Countr.Countries[4], "Name5", getAge());
        Country player6 = new Country(Countr.Countries[5], "Name6", getAge());
        Country player7 = new Country(Countr.Countries[6], "Name7", getAge());
        Country player8 = new Country(Countr.Countries[7], "Name8", getAge());
        Country player9 = new Country(Countr.Countries[8], "Name9", getAge());
        Country player10 = new Country(Countr.Countries[9], "Name10", getAge());

        // Creating 10 objects to store the 7 scores
        double [] sco1 = new double[7];
        double [] sco2 = new double[7];
        double [] sco3 = new double[7];
        double [] sco4 = new double[7];
        double [] sco5 = new double[7];
        double [] sco6 = new double[7];
        double [] sco7 = new double[7];
        double [] sco8 = new double[7];
        double [] sco9 = new double[7];
        double [] sco10 = new double[7];

        // Randomized 7 score for each person
        getScore(sco1);
        getScore(sco2);
        getScore(sco3);
        getScore(sco4);
        getScore(sco5);
        getScore(sco6);
        getScore(sco7);
        getScore(sco8);
        getScore(sco9);
        getScore(sco10);

        // Creating 10 object for Diving class
        Diving p100 = new Diving(player1,sco1, getDifficulty(), 0.0);
        Diving p200 = new Diving(player2, sco2, getDifficulty(), 0.0);
        Diving p300 = new Diving(player3, sco3, getDifficulty(), 0.0);
        Diving p400 = new Diving(player4, sco4, getDifficulty(), 0.0);
        Diving p500 = new Diving(player5, sco5, getDifficulty(), 0.0);
        Diving p600 = new Diving(player6, sco6, getDifficulty(), 0.0);
        Diving p700 = new Diving(player7, sco7, getDifficulty(), 0.0);
        Diving p800 = new Diving(player8, sco8, getDifficulty(), 0.0);
        Diving p900 = new Diving(player9, sco9, getDifficulty(), 0.0);
        Diving p1000 = new Diving(player10, sco10, getDifficulty(), 0.0);

        // Creating ArrayList for Diving
        ArrayList<Diving> dive = new ArrayList<>();

        // Adding object into the Diving ArrayList
        dive.add(p100);
        dive.add(p200);
        dive.add(p300);
        dive.add(p400);
        dive.add(p500);
        dive.add(p600);
        dive.add(p700);
        dive.add(p800);
        dive.add(p900);
        dive.add(p1000);

        // Create new ArrayList for sorting of score
        ArrayList<Diving> diveArray = new ArrayList<>();

        // Adding each diving object into the diving
        diveArray.add(p100);
        diveArray.add(p200);
        diveArray.add(p300);
        diveArray.add(p400);
        diveArray.add(p500);
        diveArray.add(p600);
        diveArray.add(p700);
        diveArray.add(p800);
        diveArray.add(p900);
        diveArray.add(p1000);


        // Display 1st game
        System.out.print("Round: 1 \nStarting position\n");
        displayGameInfo(dive);
        System.out.println(" ");
        displayResultInfo(dive);
        updateCFArray(diveArray);
        displaySortedList(diveArray);

        //Changing the score for next round
        getScore(sco1);
        getScore(sco2);
        getScore(sco3);
        getScore(sco4);
        getScore(sco5);
        getScore(sco6);
        getScore(sco7);
        getScore(sco8);
        getScore(sco9);
        getScore(sco10);

        // Changing the difficulty
        for ( int l =0; l < 10; l++)
            dive.get(l).setDifficulty(getDifficulty());

        // Display 2nd game
        System.out.print("\nRound: 2 \nStarting position\n");
        displayGameInfo(dive);
        System.out.println(" ");
        displayResultInfo(dive);
        updateCFArray(diveArray);
        displaySortedList(diveArray);

        //Changing the score for next round
        getScore(sco1);
        getScore(sco2);
        getScore(sco3);
        getScore(sco4);
        getScore(sco5);
        getScore(sco6);
        getScore(sco7);
        getScore(sco8);
        getScore(sco9);
        getScore(sco10);

        // Changing the difficulty
        for ( int l =0; l < 10; l++)
            dive.get(l).setDifficulty(getDifficulty());

        // Display 3rd game
        System.out.print("\nRound: 3 \nStarting position\n");
        displayGameInfo(dive);
        System.out.println(" ");
        displayResultInfo(dive);
        updateCFArray(diveArray);
        displaySortedList(diveArray);

        //Changing the score for next round
        getScore(sco1);
        getScore(sco2);
        getScore(sco3);
        getScore(sco4);
        getScore(sco5);
        getScore(sco6);
        getScore(sco7);
        getScore(sco8);
        getScore(sco9);
        getScore(sco10);

        // Changing the difficulty
        for ( int l =0; l < 10; l++)
            dive.get(l).setDifficulty(getDifficulty());

        // Display 4th game
        System.out.print("\nRound: 4 \nStarting position\n");
        displayGameInfo(dive);
        System.out.println(" ");
        displayResultInfo(dive);
        updateCFArray(diveArray);
        displaySortedList(diveArray);

        //Changing the score for next round
        getScore(sco1);
        getScore(sco2);
        getScore(sco3);
        getScore(sco4);
        getScore(sco5);
        getScore(sco6);
        getScore(sco7);
        getScore(sco8);
        getScore(sco9);
        getScore(sco10);

        // Changing the difficulty
        for ( int l =0; l < 10; l++)
            dive.get(l).setDifficulty(getDifficulty());

        // Display 5th game
        System.out.print("\nRound: 5 \nStarting position\n");
        displayGameInfo(dive);
        System.out.println(" ");
        displayResultInfo(dive);
        updateCFArray(diveArray);
        displaySortedList(diveArray);
    }
}

