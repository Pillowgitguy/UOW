#ifndef POINT2D_H_INCLUDED
#define POINT2D_H_INCLUDED

#include <iostream>
#include<string>

using namespace std;

class Point2D{

protected:
    int x;
    int y;
    double disFrOrigin;
    virtual void setDisFrOrigin();

public:

    // Default constructor
    Point2D();

    // Other constructor
    Point2D(int x, int y);

    // Destructor
    ~Point2D();

    // Accessor method
    int getX();
    int getY();
    int getScalarValue();

    // Setter method
    void setX(int x);
    void setY(int y);

    //Overload operator
    friend ostream& operator<<(ostream& output, const Point2D& pt);


    // toString method
    virtual string toString() const;

};

ostream& operator<<(ostream& output, const Point2D& pt);



#endif // POINT2D_H_INCLUDED
