#ifndef RECTANGLE_H_INCLUDED
#define RECTANGLE_H_INCLUDED

#include <iostream>
#include <sstream>
#include <vector>
#include <math.h>
#include <bits/stdc++.h>
#include "ShapeTwoD.h"

using namespace std;

class Rectangle : public ShapeTwoD{

protected:
    // Variables
    int noOfVertices = 4;
    string specialType;
    vector<int> actualVertexData;
    vector<int> pointsInShape;
    vector<int> pointsOnPerimeter;
    double area;

public:

    // Default constructor
    Rectangle();

    // Other constructor
    Rectangle(string name, bool containsWarpSpace, string specialType, vector<int> actualVertexData);

    // Accessor methods
    int getNoOfVertices();
    string getSpecialType();


    // toString method
    string toString() const;

    // Other methods
    double computeArea();
    bool isPointInShape(int x, int y);
    bool isPointOnShape(int x, int y);
    void inShape(vector<int> &pointsInShape);
    void onShape(vector<int> &pointsOnPerimeter);
};


#endif // RECTANGLE_H_INCLUDED
