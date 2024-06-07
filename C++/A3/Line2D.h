#ifndef LINE2D_H_INCLUDED
#define LINE2D_H_INCLUDED

#include "Point2D.h"

class Line2D{

private:
    Point2D pt1;
    Point2D pt2;

protected:
    double length;
    void setLength();

public:

    // Default constructor
    Line2D();

    // Other constructor
    Line2D(Point2D pt1, Point2D pt2);

    // Destructor
    ~Line2D();

    // Accessor method
    Point2D getPt1();
    Point2D getPt2();
    double getScalarValue();

    // Setter method
    void setPt1(Point2D pt1);
    void setPt2(Point2D pt2);

    // toString method
    virtual string toString();



};




#endif // LINE2D_H_INCLUDED
