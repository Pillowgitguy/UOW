
import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Scanner;

class QuotationItem{

    // Declaring static variables
    private String code;
    private int quantity;
    private double price;
    private double discount;

    // Constructor
    public QuotationItem (String code, int quantity, double price, double discount){
        this.code = code;
        this.quantity = quantity;
        this.price = price;
        this.discount = discount;
    }

    // Get methods
    public String getCode(){
        return code;
    }

    public double getPrice() {
        return price;
    }

    public int getQuantity(){
        return quantity;
    }

    public double getDiscount() {
        return discount;
    }

    // Set methods
    public void setPrice(double price){
        this.price = price;
    }

    public void setDiscount(double discount) {
        this.discount = discount;
    }

    // Method to get total
    public double getTotal(){
        return (quantity * price) * (1 - discount);
    }

    // Displaying info
    @Override
    public String toString(){
        return "\nProduct Code: " + code +
                "\nQuantity: " + quantity +
                "\nPrice: $" + price +
                "\nDiscount: " + discount +
                "\nNet Price: $" + getTotal();
    }
}

class QuotationApp extends JFrame {

    private JTextField txCode;
    private JTextField txQuantity;
    private JTextField txPrice;
    private JTextField txDiscount;
    private JTextField txTotal;
    private JButton bnLoad;
    private JButton bnPrev;
    private JButton bnNext;
    private ArrayList<QuotationItem> itemList = new ArrayList<>();
    private int index = 0;


    // Constructor
    public QuotationApp (){
        createUI();
    }

    private void createUI(){

        // Title of GUI
        this.setTitle("Quotation Management");

        // Setting GUI to appear in the center of the screen
        this.setLocationRelativeTo(null);

        // Close the GUI when user click X
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // Create UI
        JLabel lbCode = new JLabel("Code");
        JLabel lbQuantity = new JLabel("Quantity");
        JLabel lbPrice = new JLabel("Price");
        JLabel lbDiscount = new JLabel("Discount");
        JLabel lbTotal = new JLabel("Total");
        JLabel lbEmpty = new JLabel("");
        txCode= new JTextField();
        txQuantity = new JTextField();
        txPrice = new JTextField();
        txDiscount = new JTextField();
        txTotal = new JTextField();
        bnLoad = new JButton("Load");
        bnPrev = new JButton("Prev");
        bnNext = new JButton("Next");

        // Disabling the txt & bn
        txCode.setEnabled(false);
        txQuantity.setEnabled(false);
        txPrice.setEnabled(false);
        txDiscount.setEnabled(false);
        txTotal.setEnabled(false);
        bnPrev.setEnabled(false);
        bnNext.setEnabled(false);

        // Setting the layout of the JFrame, separating each component vertically by 10 px
        this.setLayout(new BorderLayout(0,10));

        // Creating panels
        JPanel centerLayout = new JPanel();
        centerLayout.setLayout(new GridLayout(5, 2,0,2));
        centerLayout.setPreferredSize(new Dimension(400,250));

        JPanel southLayout = new JPanel();
        southLayout.setLayout(new GridLayout(1,2));
        southLayout.setPreferredSize(new Dimension(400,40));

        JPanel buttonsLayout = new JPanel();
        buttonsLayout.setLayout(new FlowLayout(FlowLayout.LEFT, 0 ,0));

        // Adding UI components to the panels
        centerLayout.add(lbCode);
        centerLayout.add(txCode);
        centerLayout.add(lbQuantity);
        centerLayout.add(txQuantity);
        centerLayout.add(lbPrice);
        centerLayout.add(txPrice);
        centerLayout.add(lbDiscount);
        centerLayout.add(txDiscount);
        centerLayout.add(lbTotal);
        centerLayout.add(txTotal);

        southLayout.add(lbEmpty);
        buttonsLayout.add(bnLoad);
        buttonsLayout.add(bnPrev);
        buttonsLayout.add(bnNext);

        // Adding buttonLayout into southLayout
        southLayout.add(buttonsLayout);

        this.add(centerLayout, BorderLayout.CENTER);
        this.add(southLayout, BorderLayout.SOUTH);

        // Resize screen to fit all UI components
        this.pack();

        // Add event handlers
        addHandlers();
    }

    private void addHandlers(){

        // Create an ActionListener for loading the data
        ActionListener loadListener = new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
            readFile();
            }
        };

        // Add the listener to bnLoad
        bnLoad.addActionListener(loadListener);

        // Create an ActionListener for displaying next data
        ActionListener nextListener = new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e)   {
                next();
            }
        };

        // Add the listener to bnNext
        bnNext.addActionListener(nextListener);

        // Create an ActionListener for displaying prev data
        ActionListener prevListener = new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                prev();
            }
        };

        // Add the listener to bnPrev
        bnPrev.addActionListener(prevListener);
    }

    private void readFile(){
        // Reading info from external file
        try (Scanner reader = new Scanner(new File("Data.txt"))) {

            // Loop till there is nothing left to read in the file
            while (reader.hasNext()) {
                // Read one line from the file
                String oneLine = reader.nextLine();

                // Break each line into parts and place them into a String array
                String[] values = oneLine.split(",");

                // Creating QuotationItem from the String array
                QuotationItem item = new QuotationItem(values[0], Integer.parseInt(values[1]), Double.parseDouble(values[2]), Double.parseDouble(values[3]));

                // Doing validation on price and quantity before adding them into the ArrayList
                if (item.getPrice() > 0 && item.getQuantity() > 0)
                    itemList.add(item);
            }
        }
        catch (FileNotFoundException err) {
            // Doing validation if unable to find the file, there will be a pop out box
            JOptionPane.showMessageDialog(
                    null,
                    "No quotation record",
                    "Message",
                    JOptionPane.INFORMATION_MESSAGE);
        }

        // Doing validation if the file read is empty,so the program will not crash
        if (itemList.isEmpty()){
            JOptionPane.showMessageDialog(
                    null,
                    "File is empty or data is input wrongly",
                    "Message",
                    JOptionPane.INFORMATION_MESSAGE);
        }

        // Displaying the 0th index in the arrayList
        else {
            txCode.setText(itemList.get(index).getCode());
            txQuantity.setText(String.valueOf(itemList.get(index).getQuantity()));
            txPrice.setText(String.valueOf(itemList.get(index).getPrice()));
            txDiscount.setText(String.valueOf(itemList.get(index).getDiscount()));
            txTotal.setText(String.valueOf(itemList.get(index).getTotal()));
            bnLoad.setEnabled(false);
            bnNext.setEnabled(true);
        }
    }

    // Getting the next index in the arrayList
    private void next(){
        index++;
        txCode.setText(itemList.get(index).getCode());
        txQuantity.setText(String.valueOf(itemList.get(index).getQuantity()));
        txPrice.setText(String.valueOf(itemList.get(index).getPrice()));
        txDiscount.setText(String.valueOf(itemList.get(index).getDiscount()));
        txTotal.setText(String.valueOf(itemList.get(index).getTotal()));

        // Disabling the bnNext if it is the end of the arrayList
        if (index == itemList.size() - 1)
            bnNext.setEnabled(false);

        bnPrev.setEnabled(true);
    }

    // Getting the prev index in the arrayList
    private void prev(){
        index--;
        txCode.setText(itemList.get(index).getCode());
        txQuantity.setText(String.valueOf(itemList.get(index).getQuantity()));
        txPrice.setText(String.valueOf(itemList.get(index).getPrice()));
        txDiscount.setText(String.valueOf(itemList.get(index).getDiscount()));
        txTotal.setText(String.valueOf(itemList.get(index).getTotal()));

        // Disabling the bnPrev if it is the start of the arrayList
        if (index == 0)
            bnPrev.setEnabled(false);

        bnNext.setEnabled(true);
    }
}


public class T1_ChuaTianSheng_A3 {
    public static void main(String[] args) {

        // Enabling the visibility of the GUI
        new QuotationApp().setVisible(true);
    }
}
