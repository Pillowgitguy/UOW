#include <iostream>
#include <sstream>
#include <string>
#include <math.h>
#include "Circle.h"

using namespace std;

// Circle default constructor
Circle :: Circle(){

}

// Circle other constructor
Circle :: Circle(string name, bool containsWarpSpace, string specialType, vector<int> actualVertexData) : ShapeTwoD (name, containsWarpSpace){

    this->specialType = specialType;
    this->actualVertexData = actualVertexData;
    inShape(pointsInShape);
    onShape(pointsOnPerimeter);
    area = computeArea();

}

// Accessor methods
int Circle :: getNoOfVertices(){
    return noOfVertices;
}

string Circle :: getSpecialType(){
    return specialType;
}


string Circle :: toString() const{

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

// Circle other methods
double Circle :: computeArea(){

    // Area of circle = pi * (radius)^2
    return M_PI * (actualVertexData[2] * actualVertexData[2] );
}

void Circle :: inShape(vector<int> &pointsInShape){

    int base;
    int base2;
    int counter = 0;
    bool result = false;
    // x - radius
    int lowestX = actualVertexData[0] - actualVertexData[2];
    // y - radius
    int lowestXY = actualVertexData[1] -  actualVertexData[2];

    // x + radius
    int highestX = actualVertexData[0] + actualVertexData[2];
    // y + radius
    int highestXY = actualVertexData[1] +  actualVertexData[2];

    int length = abs(lowestX - highestX);
    int height = abs(highestXY - lowestXY);

    base = lowestX+1;
    base2 = lowestXY+1;
    // input values
    for (int i = 0; i < height-1; i++){

        for (int j = 0; j < length-1; j++){
            pointsInShape.push_back(base++);
            pointsInShape.push_back(base2+counter);
        }
        base = lowestX+1;
        base2 = lowestXY+1;
        counter++;
    }

}

bool Circle :: isPointInShape(int x, int y){

    bool result = false;

    for (int i = 0; i < pointsInShape.size(); i = i + 2 ){
        if (x == pointsInShape[i] && y == pointsInShape[i+1]){
            result = true;
        }
    }

    return result;
}


void Circle :: onShape(vector<int> &pointsOnPerimeter){

    // x - radius, left
    int lowestX = actualVertexData[0] - actualVertexData[2];

    // x + radius right
    int highestX = actualVertexData[0] + actualVertexData[2];

    // Bottom
    int lowestXY2 = actualVertexData[1] - actualVertexData[2] ;

    // Top
    int highestXY2 = actualVertexData[1] + actualVertexData[2];


    pointsOnPerimeter.push_back(lowestX);
    pointsOnPerimeter.push_back(actualVertexData[1]);
    pointsOnPerimeter.push_back(highestX);
    pointsOnPerimeter.push_back(actualVertexData[1]);
    pointsOnPerimeter.push_back(actualVertexData[0]);
    pointsOnPerimeter.push_back(lowestXY2);
    pointsOnPerimeter.push_back(actualVertexData[0]);
    pointsOnPerimeter.push_back(highestXY2);

}


bool Circle :: isPointOnShape(int x, int y){

    bool result = false;

    for (int i = 0; i < pointsOnPerimeter.size(); i++){
        if (x == pointsOnPerimeter[i] && y == pointsOnPerimeter[i+1]){
            result = true;
        }
    }
    return result;
}
