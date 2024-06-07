#ifndef CIRCLE_H_INCLUDED
#define CIRCLE_H_INCLUDED

#include <vector>
#include <iostream>
#include "ShapeTwoD.h"


using namespace std;

class Circle : public ShapeTwoD{

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
    Circle();

    // Other constructor
    Circle(string name, bool containsWarpSpace, string specialType, vector<int> actualVertexData);

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


#endif // CIRCLE_H_INCLUDED
