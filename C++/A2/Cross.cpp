#include <iostream>
#include <sstream>
#include <vector>
#include <math.h>
#include <bits/stdc++.h>
#include "Cross.h"

using namespace std;


// Cross default constructor
Cross :: Cross(){

}

// Cross other constructor
Cross :: Cross(string name, bool containsWarpSpace, string specialType, vector<int> actualVertexData) : ShapeTwoD (name, containsWarpSpace){

    this->specialType = specialType;
    this->actualVertexData = actualVertexData;
    inShape(pointsInShape);
    onShape(pointsOnPerimeter);
    area = computeArea();

}

// Accessor methods
int Cross :: getNoOfVertices(){
    return noOfVertices;
}

string Cross :: getSpecialType(){
    return specialType;
}


string Cross :: toString() const{

     ostringstream oss;
    string WS;

    if (containsWarpSpace == 1){
        WS = "WS";
    }
    else{
        WS = "NS";
    }
    oss << "Name:  " << name << endl;
    oss << "Special Type: " << WS << endl;
    oss << "Area: " << area << " units square" << endl;


    oss << "Points on perimeter: ";
    for (int i = 0; i < pointsOnPerimeter.size(); i = i + 2 ){

        if (i < pointsOnPerimeter.size()-2){
                oss <<  "("<<pointsOnPerimeter[i] << ", " << pointsOnPerimeter[i+1] << "),";
        }
        else{
                oss <<  "("<<pointsOnPerimeter[i] << ", " << pointsOnPerimeter[i+1] << ")";
        }

    }
    oss << endl;

    oss << "Points on within Shape: ";
    for (int i = 0; i < pointsInShape.size(); i = i + 2 ){
        if (i < pointsInShape.size()-2){
                oss <<  "("<<pointsInShape[i] << ", " << pointsInShape[i+1] << "),";
        }
        else{
                oss <<  "("<<pointsInShape[i] << ", " << pointsInShape[i+1] << ")";
        }

    }
    oss << endl;

    return (oss.str());

}

// Cross other methods
double Cross :: computeArea(){

    double area;
    double xTotal = 0;
    double yTotal = 0;

    // Usage of shoelace method to calculate the area of the cross
    for (int i = 0; i < actualVertexData.size()-2; i = i + 2){

        xTotal = xTotal + (actualVertexData[i] * actualVertexData[i+3]);
        yTotal = yTotal + (actualVertexData[i+1]) * actualVertexData[i+2];

    }

    area = (xTotal - yTotal) * 1/2;

    return area;
}

void Cross :: inShape(vector<int> &pointsInShape){

    int lowestY;
    int lowestYX;
    int lowestYX2;
    int btmLength;
    int lowestCounter = 0;
    int highestY = 0;
    int highestYX;
    int highestYX2;
    int highestCounter = 0;
    int firstHeight;
    int base;
    int base2;
    int lowestX;
    int highestX = 0;
    int highestXY;
    int lowestXY;


    for (int i = 1; i < actualVertexData.size(); i = i + 2){

        // Find the lowest y
        if (lowestY > actualVertexData[i]){
            lowestY = actualVertexData[i];
        }
        // Find the highest y
        if (highestY < actualVertexData[i]){
            highestY = actualVertexData[i];
        }
    }

    // Find the both x with the lowest y
    for (int i = 1; i < actualVertexData.size(); i = i + 2){

        // First x with the lowest y
        if (actualVertexData[i] == lowestY && lowestCounter == 0){
            lowestYX = actualVertexData[i-1];
            lowestCounter++;
        }

        // Second x with the lowest y
        if (actualVertexData[i] == lowestY && lowestCounter != 0){
            lowestYX2 = actualVertexData[i-1];
        }

        // First X with the highest Y
        if (actualVertexData[i] == highestY && highestCounter == 0){
            highestYX = actualVertexData[i-1];
            highestCounter++;
        }

        // Second X with the highest Y
        if (actualVertexData[i] == highestY && highestCounter != 0){
            highestYX2 = actualVertexData[i-1];
        }
    }
    lowestCounter = 0;

    firstHeight = abs(lowestY-highestY);
    btmLength = abs(lowestYX - lowestYX2);

    // Input values
    if (lowestYX > lowestYX2){
        base = lowestYX2+1;
    }
    else{
        base = lowestYX+1;
    }
    base2 = lowestY+1;
    for (int i = 0; i < firstHeight-1; i++){
        for (int j = 0; j < btmLength-1; j++){
            pointsInShape.push_back(base++);
            pointsInShape.push_back(base2+lowestCounter);
        }

        if (lowestYX > lowestYX2){
            base = lowestYX2+1;
        }
        else{
            base = lowestYX+1;
        }

        base2 = lowestY+1;
        lowestCounter++;
    }

    lowestCounter = 0;

    for (int i = 0; i < actualVertexData.size(); i = i +2){
        // Find the lowest x
        if (lowestX > actualVertexData[i]){
            lowestX = actualVertexData[i];
        }
        // Find the highest x
        if (highestX < actualVertexData[i]){
            highestX = actualVertexData[i];
        }
    }

    for (int i = 0; i < actualVertexData.size(); i = i + 2){

        // Getting the first y with the lowest x
        if (lowestX == actualVertexData[i] && lowestCounter == 0){
            lowestXY = actualVertexData[i+1];
            lowestCounter++;
        }
        // Getting the second y with the lowest x
        else if (lowestX == actualVertexData[i] && lowestCounter != 0){
            highestXY = actualVertexData[i+1];
        }

    }

    lowestCounter = 0;
    firstHeight = abs(lowestXY - highestXY);
    btmLength = abs(lowestX - highestX);

    if (lowestXY > highestXY){
        base2 = highestXY+1;
    }
    else{
        base2 = lowestXY+1;
    }
    base = lowestX+1;
    for (int i = 0; i < firstHeight-1; i++){
        for (int j = 0; j < btmLength-1; j++){
            pointsInShape.push_back(base++);
            pointsInShape.push_back(base2+lowestCounter);
        }
        base = lowestX+1;

        if (lowestXY > highestXY){
            base2 = highestXY+1;
        }
        else{
            base2 = lowestXY+1;
        }

        lowestCounter++;
    }


}

void Cross :: onShape(vector<int> &pointsOnPerimeter){

    int difference;
    int counter = 1;

    for (int i = 0; i < actualVertexData.size()-2; i = i + 2){

        // if the next x is the same value
        if(actualVertexData[i] == actualVertexData[i+2]){
            // first y - second y
            difference = abs(actualVertexData[i+1] - actualVertexData[i+3]);
            // The points are not next to each other
            if (difference > 0){

                // first y is bigger than second y
                if (actualVertexData[i+1] > actualVertexData[i+3]){
                    for (int j = 0; j < difference-1; j++){
                        pointsOnPerimeter.push_back(actualVertexData[i]);
                        pointsOnPerimeter.push_back(actualVertexData[i+1] - counter);
                        counter++;
                    }
                }

                // second y is bigger than first y
                else {
                    for (int j = 0; j < difference-1; j++){
                        pointsOnPerimeter.push_back(actualVertexData[i+2]);
                        pointsOnPerimeter.push_back(actualVertexData[i+3] - counter);
                        counter++;
                    }
                }


            }
            else {
                // When the points is just next to each other, these is no points in between them
            }
        }

        // if the next x is not of the same value
        if (actualVertexData[i] != actualVertexData[i+2]){

            // first x - second x
            difference = abs(actualVertexData[i] - actualVertexData[i+2]);

            // points are not to each other
            if (difference > 0){
                // first x is bigger than second x
                if (actualVertexData[i] > actualVertexData[i+2]){

                    for (int j = 0; j < difference-1; j++){
                        pointsOnPerimeter.push_back(actualVertexData[i] - counter);
                        pointsOnPerimeter.push_back(actualVertexData[i+1]);
                        counter++;
                    }

                }
                // second x is bigger than first x
                else {
                    for (int j = 0; j < difference-1; j++){
                        pointsOnPerimeter.push_back(actualVertexData[i+2]-counter);
                        pointsOnPerimeter.push_back(actualVertexData[i+3]);
                        counter++;
                    }
                }

            }

            // points are just next to each other
            else {

            }
        }

        // Reseting of the counter
        difference = 0;
        counter = 1;

    }

// comparing the last x to first x
    // if the next x is the same value
    if(actualVertexData[0] == actualVertexData[22]){
        // first y - second y
        difference = abs(actualVertexData[1] - actualVertexData[23]);
        // The points are not next to each other
        if (difference > 0){

            // first y is bigger than second y
            if (actualVertexData[1] > actualVertexData[19]){
                for (int j = 0; j < difference-1; j++){
                    pointsOnPerimeter.push_back(actualVertexData[0]);
                    pointsOnPerimeter.push_back(actualVertexData[1] - counter);
                    counter++;
                }
            }

            // second y is bigger than first y
            else {
                for (int j = 0; j < difference-1; j++){
                    pointsOnPerimeter.push_back(actualVertexData[22]);
                    pointsOnPerimeter.push_back(actualVertexData[23] - counter);
                    counter++;
                }
            }


        }
        else {
            // When the points is just next to each other, these is no points in between them
        }
    }
    // if the next x is not of the same value
    if (actualVertexData[0] != actualVertexData[22]){

        // first x - second x
        difference = abs(actualVertexData[0] - actualVertexData[22]);
        // points are not to each other
        if (difference > 0){
            // first x is bigger than second x
            if (actualVertexData[0] > actualVertexData[22]){

                for (int j = 0; j < difference-1; j++){
                    pointsOnPerimeter.push_back(actualVertexData[0] - counter);
                    pointsOnPerimeter.push_back(actualVertexData[1]);
                    counter++;

                }

            }
            // second x is bigger than first x
            else {
                for (int j = 0; j < difference-1; j++){
                    pointsOnPerimeter.push_back(actualVertexData[22]-counter);
                    pointsOnPerimeter.push_back(actualVertexData[23]);
                    counter++;
                }
            }

        }

        // points are just next to each other
        else {

        }
    }

    // Reseting of the counter
    counter = 1;

}

bool Cross :: isPointInShape(int x, int y){

    bool result = false;

    for (int i = 0; i < pointsInShape.size(); i = i +2){\
        if (x == pointsInShape[i] && y == pointsInShape[i+1]){
            result = true;
        }
    }

    return result;
}

bool Cross :: isPointOnShape(int x, int y){

    bool result = false;

    // Looping through the vector to check if the x,y inputted got appear
    for (int i = 0; i < pointsOnPerimeter.size(); i++){
        if (x == pointsOnPerimeter[i] && y == pointsOnPerimeter[i+1]){
            result = true;
        }
    }

    return result;
}

