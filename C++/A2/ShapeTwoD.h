#ifndef SHAPETWOD_H_INCLUDED
#define SHAPETWOD_H_INCLUDED

#include <iostream>

using namespace std;

class ShapeTwoD{

protected:
    string name;
    bool containsWarpSpace;

public:

    // Default constructor
    ShapeTwoD();

    // Other constructor
    ShapeTwoD(string name, bool containsWarpSpace);

    // Destructor
    virtual ~ShapeTwoD();

    // Accessor method
    string getName();
    bool getContainWarpSpace();

    // Setter method
    string setName(string name);
    bool setcontainsWarpSpace(bool containsWarpSpace);

    // toString method
    virtual string toString() const;

    // Other methods
    virtual double computeArea();
    virtual bool isPointInShape(int x, int y);
    virtual bool isPointOnShape(int x, int y);


};


#endif // SHAPETWOD_H_INCLUDED
