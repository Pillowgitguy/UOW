#include <iostream>
#include <sstream>
#include <vector>
#include <math.h>
#include <bits/stdc++.h>
#include "ShapeTwoD.h"
#include "Square.h"
#include "Rectangle.h"
#include "Cross.h"
#include "Circle.h"

using namespace std;

// Function prototypes
void inputSensorData();

string tempChoice;
int userChoice;
vector<ShapeTwoD*> shapeVector;
int noOfShapes;
int counter = 0;

int main()
{

    while (userChoice != 5){

        try{
            // Student's information
            cout << "Student ID     : 7432434" << endl;
            cout << "Student Name   : Chua Tian Sheng" << endl;
            cout << "------------------------------------------" << endl;

            // Main menu
            cout << "Welcome to Assn2 program!" << endl;

            cout << "\n1)       Input senor data" << endl;
            cout << "2)       Compute area(for all records)" << endl;
            cout << "3)       Print shape report" << endl;
            cout << "4)       Sort shape data" << endl;
            cout << "5)       Quit" << endl;

            cout << "\nPlease enter your choice: ";
            cin >> tempChoice;

            userChoice = stoi(tempChoice);

            // Informing user to input int from 1 to 8
            if (userChoice >5 || userChoice <= 0){
                cout << "Please enter number from 1 to 5 only\n" << endl;
            }

            switch(userChoice){
                case 1:
                    inputSensorData();
                    break;
                case 2:
                    cout << "Computation completed! (" << noOfShapes << " records were updated)" << endl;
                    // Invoking the computeArea for each type of shape
                    for (int i = 0; i < shapeVector.size(); i++){
                        shapeVector[i]->computeArea();
                    }
                    break;
                case 3:
                    for (int i = 0; i < shapeVector.size(); i++){
                        cout << "Shape[" << i << "]" << endl;
                        cout << shapeVector[i]->toString() << endl;
                        counter++;
                    };
                    cout << "Total no. of records available = " << noOfShapes << endl;
                    // Reset counter
                    counter = 0;
                    break;
                case 4:
                    tempChoice = " ";

                    while (true){

                        cout << "a)     Sort by area (ascending)" << endl;
                        cout << "b)     Sort by area (descending)" << endl;
                        cout << "c)     Sort by special and area" << endl;
                        cout << "\nPlease select sort option ('q' to go main menu): ";
                        cin >> tempChoice;

                        if (tempChoice == "a"){
                            vector<double> areaList;
                            int c = 0;

                            cout << "Sort by area (Smallest to Largest)..." << endl;

                            for(int i = 0; i < shapeVector.size(); i++ ){

                                areaList.push_back(shapeVector[i]->computeArea());
                            }

                            // Sort the vector in ascending order
                            sort(areaList.begin(), areaList.end());



                            for(int i = 0; i < areaList.size(); i++ ){
                                    for (int j = 0; j < shapeVector.size(); j++){
                                        if (areaList[i] == shapeVector[j]->computeArea()){
                                            cout << "Shape[" << c << "]" << endl;
                                            cout << shapeVector[j]->toString() << endl;
                                            c++;
                                        }
                                    }
                            }

                        }
                        else if (tempChoice == "b"){

                            vector<double> areaList;
                            int c = 0;

                            cout << "Sort by area (Largest to smallest)..." << endl;


                            for(int i = 0; i < shapeVector.size(); i++ ){
                                areaList.push_back(shapeVector[i]->computeArea());
                            }

                            // Sort the vector in descending order
                            sort(areaList.begin(), areaList.end(), greater<double>());

                            // Displaying in descending order
                            for(int i = 0; i < areaList.size(); i++ ){
                                    for (int j = 0; j < shapeVector.size(); j++){
                                        if (areaList[i] == shapeVector[j]->computeArea()){
                                            cout << "Shape[" << c << "]" << endl;
                                            cout << shapeVector[j]->toString() << endl;
                                            c++;
                                        }
                                    }
                            }


                        }
                        else if (tempChoice == "c"){
                            vector<double> areaList;
                            int c = 0;

                            cout << "Sort by special type and area..." << endl;

                            // Taking the area and put into a vector
                            for(int i = 0; i < shapeVector.size(); i++ ){
                                areaList.push_back(shapeVector[i]->computeArea());
                            }

                            // Sort the vector
                            sort(areaList.begin(), areaList.end(), greater<double>());


                            // Displaying in descending order of WS
                            for(int i = 0; i < areaList.size(); i++ ){
                                    for (int j = 0; j < shapeVector.size(); j++){
                                        if (areaList[i] == shapeVector[j]->computeArea() && shapeVector[j]->getContainWarpSpace() == true){
                                            cout << "Shape[" << c << "]" << endl;
                                            cout << shapeVector[j]->toString() << endl;
                                            c++;                                        }
                                    }
                            }

                            // Displaying in descending order of NS
                            for(int i = 0; i < areaList.size(); i++ ){
                                    for (int j = 0; j < shapeVector.size(); j++){
                                        if (areaList[i] == shapeVector[j]->computeArea() && shapeVector[j]->getContainWarpSpace() == false){
                                            cout << "Shape[" << c << "]" << endl;
                                            cout << shapeVector[j]->toString() << endl;
                                            c++;                                        }
                                    }
                            }

                        }
                        else if (tempChoice == "q"){
                            break;
                        }

                        else {
                            cout << "Please input either a, b,c or q only!!" << endl;
                        }
                    }

                    break;

                case 5:
                    cout << "5" << endl;
                    for (int i = 0; i < shapeVector.size(); i++ ){
                        delete shapeVector[i];
                    }

                    break;

            }

        }

        // Case when user input string
        catch (invalid_argument convert){
            cout << "Please input numbers only!!\n" << endl;
        }

    }

    return 0;
}

void inputSensorData(){

    string shapeName;
    string typeName;
    bool containsWarpSpace;

    vector<int> vertexData;
    int x;
    int y;
    int radius;

    cout << "\n[Input sensor data]" << endl;

    // Making sure the user only input the 4 types of shapes
    while (true){
        cout << "Please enter name of shape: ";
        cin >> shapeName;

        if (shapeName == "Square" || shapeName == "Rectangle" || shapeName == "Cross" || shapeName == "Circle"){
            break;
        }
        else {
            cout << "Please input only Square, Rectangle, Cross or Circle!" << endl;
        }
    }

    // Making sure the user only input WS or NS for type name
    while (true){
        cout << "Please enter special type: ";
        cin >> typeName;

        if (typeName == "WS"){
            containsWarpSpace = true;
            break;
        }
        if (typeName == "NS"){
            containsWarpSpace = false;
            break;
        }
        else {
            cout << "Please input only WS or NS!" << endl;
        }
    }



    // Case for Square
    if (shapeName == "Square"){

        // Prompting the user to input the x and y coordinates
        for (int i = 1; i < 5; i++){
            cout << "Please enter x-ordinate of pt." << i << ": ";
            cin >> x;
            cout << "Please enter y-ordinate of pt." << i << ": ";
            cin >> y;
            vertexData.push_back(x);
            vertexData.push_back(y);
        }

        // Creating the square
        shapeVector.push_back(new Square(shapeName, containsWarpSpace, typeName, vertexData));
    }

    // Case for Rectangle
    else if (shapeName == "Rectangle"){

        // Prompting the user to input the x and y coordinates
        for (int i = 1; i < 5; i++){
            cout << "Please enter x-ordinate of pt." << i << ": ";
            cin >> x;
            cout << "Please enter y-ordinate of pt." << i << ": ";
            cin >> y;
            vertexData.push_back(x);
            vertexData.push_back(y);
        }

        // Creating the rectangle
        shapeVector.push_back(new Rectangle(shapeName, containsWarpSpace, typeName, vertexData));

    }

    // Case for Cross
    else if (shapeName == "Cross"){

        // Prompting the user to input the x and y coordinates
        for (int i = 1; i < 13; i++){
            cout << "Please enter x-ordinate of pt." << i << ": ";
            cin >> x;
            cout << "Please enter y-ordinate of pt." << i << ": ";
            cin >> y;
            vertexData.push_back(x);
            vertexData.push_back(y);
        }

        // Creating the cross
        shapeVector.push_back(new Cross(shapeName, containsWarpSpace, typeName, vertexData));
    }

    // Case for  Circle
    else {
        // Prompting the user to input the x and y coordinates
        for (int i = 0; i < 1; i++){
            cout << "Please enter x-ordinate of center: ";
            cin >> x;
            cout << "Please enter y-ordinate of center: ";
            cin >> y;
            vertexData.push_back(x);
            vertexData.push_back(y);
        }

        cout << "Please enter radius(units): ";
        cin >> radius;
        vertexData.push_back(radius);

        // Creating the circle
        shapeVector.push_back(new Circle(shapeName, containsWarpSpace, typeName, vertexData));

    }


    noOfShapes++;
    cout << "\nRecord successfully stored. Going back to main menu..." << endl;

}
