#========== Edit student info ===================#
name = 'Chua Tian Sheng'  # (1) REPLACE THE STRING VARIABLE WITH YOUR NAME in string type
student_num = '7432434' # (2) REPLACE THIS STRING VARIABLE WITH YOUR UOW ID in string type
subject_code = 'CSIT110'
#========== End of student info =================#
#========== Define function definitions here ====#
# Question 1
def g(f):
    # Multiple receiving value (f) by 9.81, change the resulting value into float and return the float value back
    return float(f * 9.81)

# Question 2
def get_type(data):
    # Pass receiving value (data) into function type and return it
    return type(data)

# Question 3
def get_equation():
    # Prompt user to enter two numbers and save it into two variables
    first_number = float(input("Enter first number: "))
    second_number = float(input("Enter second number: "))

    # sum of first and second number
    total = first_number + second_number

    # The str object to be returned
    equation = str(first_number) + " + " + str(second_number)

    return total, equation

# Question 4
def filter_by(fcn, n : int):
    # If value returned from given function is bigger than n, return True
    if fcn() > n:
        return True
    else:
        return False

# Question 5
def format_price(f : float):
    # Printing given argument as 2 decimal place
    print(f"${f:.2f}")
    # Returning string object
    return f"${f:.2f}"


#========== End of function definition===========#
def main():   ## DO NOT EDIT THIS LINE.
    print("Assignment1")  ## DO NOT EDIT THIS LINE.
    #========== Call your functions here ========#
    # Question 1
    x = g(60)
    print(x)

    # Question 2
    print(get_type(123))
    print(get_type("hohoho"))

    # Question 3
    x, y = get_equation()
    print(x)
    print(y)

    # Question 4
    def test_fcn1():
        return 3 * 3

    x = filter_by(test_fcn1, 16)
    y = filter_by(test_fcn1, 4)
    print(x)
    print(y)

    # Question 5
    x = format_price(2.3)
    print(x)

    #========== End of function calls ===========#

if __name__ == '__main__':  ## DO NOT EDIT THIS LINE.
    main()  ## DO NOT EDIT THIS LINE.
