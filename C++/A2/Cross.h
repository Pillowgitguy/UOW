#ifndef CROSS_H_INCLUDED
#define CROSS_H_INCLUDED

#include <iostream>
#include <sstream>
#include <vector>
#include <math.h>
#include <bits/stdc++.h>
#include "ShapeTwoD.h"

using namespace std;


class Cross : public ShapeTwoD  {

protected:
    // Variables
    int noOfVertices = 12;
    string specialType;
    vector<int> actualVertexData;
    vector<int> pointsInShape;
    vector<int> pointsOnPerimeter;
    double area;

public:

    // Default constructor
    Cross();

    // Other constructor
    Cross(string name, bool containsWarpSpace, string specialType, vector<int> actualVertexData);

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





#endif // CROSS_H_INCLUDED
