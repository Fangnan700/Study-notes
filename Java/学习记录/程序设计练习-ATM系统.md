# 程序设计练习-ATM系统

## 项目介绍

使用Java语言开发一个ATM模拟系统，要求实现以下功能：

- 注册：读取用户输入的用户名称和用户密码，随机生成一个卡号与该用户绑定（要求每次生成的卡号不能与已有的卡号重复）
- 登录：用户输入卡号和密码，若与已有的用户信息匹配，则输出该用户的账户信息
- 转账：根据用户输入的转账卡号，将当前用户名下的款项转给另一名用户
- 修改密码
- 注销账户



## 技术选型

![image-20220707153707966](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220707153707966.png)



## 代码实现

```java
public class Account {
    private String userName;
    private String userPassword;
    private double balance;
    private int limit;

    private String userNumber;

    public String getUserNumber() {
        return userNumber;
    }

    public void setUserNumber(String userNumber) {
        this.userNumber = userNumber;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getUserPassword() {
        return userPassword;
    }

    public void setUserPassword(String userPassword) {
        this.userPassword = userPassword;
    }

    public double getBalance() {
        return balance;
    }

    public void setBalance(double balance) {
        this.balance = balance;
    }

    public int getLimit() {
        return limit;
    }

    public void setLimit(int limit) {
        this.limit = limit;
    }
}
```

```java
import java.util.ArrayList;
import java.util.Scanner;
import java.util.Random;

public class ATM_System {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Random ra = new Random();
        ArrayList<Account> user_array = new ArrayList<>();      //存储用户信息的集合，每个元素是一个用户信息对象
        ArrayList<String> userNumber_array = new ArrayList<>(); //存储已经存在的卡号

        //主界面
        while (true) {
            System.out.println("==========欢迎使用ATM系统==========");
            System.out.println(">> 1、登录");
            System.out.println(">> 2、注册");
            System.out.println(">> 3、退出");

            int main_menu_command = sc.nextInt();
            String userNumber = create_userNumber(userNumber_array);
            switch (main_menu_command) {
                case 1 -> login(sc, user_array);
                case 2 -> signup(sc, ra, userNumber, user_array);
                case 3 -> System.exit(0);
                default -> System.out.println("输入有误，请检查后重试!");
            }
        }
    }

    //登录模块
    private static void login(Scanner sc, ArrayList<Account> userArray) {
        while (true) {
            System.out.println("==========欢迎使用ATM系统==========");
            System.out.println("请输入卡号：");
            String userNumber = sc.next();
            System.out.println("请输入密码：");
            String userPassword = sc.next();
            int whetherExist = 0;
            int index = 0;
            for (int  i = 0; i < userArray.size(); i++) {
                if (userNumber.equals(userArray.get(i).getUserNumber())) {
                    whetherExist = 1;
                    index = i;
                    break;
                }
            }
            if (whetherExist == 1) {
                if (userPassword.equals(userArray.get(index).getUserPassword())) {
                    int whetherStop = 0;
                    while (true) {
                        System.out.println("==========欢迎使用ATM系统==========");
                        System.out.println(">> 1、查询");
                        System.out.println(">> 2、存款");
                        System.out.println(">> 3、取款");
                        System.out.println(">> 4、转账");
                        System.out.println(">> 5、退出");

                        int command_1 = sc.nextInt();
                        switch (command_1) {
                            case 1 :
                                query(sc, userArray, index);
                                break;
                            case 2 :
                                deposit(sc, userArray, index);
                                break;
                            case 3 :
                                withdrawal(sc, userArray, index);
                                break;
                            case 4 :
                                transfer(sc, userArray, index);
                                break;
                            case 5 :
                                whetherStop = 1;
                                break;
                            default : System.out.println("输入有误，请检查后重试！");
                        }
                        if (whetherStop == 1)
                            break;
                    }
                    break;
                }
                else {
                    System.out.println("密码错误，请重试！");
                }
            }
            else {
                System.out.println("您输入的卡号不存在，请检查后重试!");
            }
        }
    }

    private static void transfer(Scanner sc, ArrayList<Account> user_array, int index) {
        while (true) {
            System.out.println("==========欢迎使用ATM系统==========");
            System.out.println("请输入要转账到的卡号：");
            String to_userNumber = sc.next();
            int to_index = 0;
            int whetherExist = 0;
            for (int i = 0; i < user_array.size(); i++) {
                if (to_userNumber.equals(user_array.get(i).getUserNumber())) {
                    to_index = i;
                    whetherExist = 1;
                    break;
                }
            }
            if (whetherExist == 1) {
                String to_name = user_array.get(to_index).getUserName().replace(user_array.get(to_index).getUserName().substring(0, 1), "*");
                System.out.println("您确定要给" + to_name + "转账吗？（y/n）");
                String command_2 = sc.next();
                if (command_2.equals("y")) {
                    while (true) {
                        System.out.println("您的余额为：" + user_array.get(index).getBalance());
                        System.out.println("请输入要转账的金额：");
                        double transfer_amount = sc.nextDouble();
                        if (transfer_amount >= 0) {
                            if (transfer_amount <= user_array.get(index).getBalance()) {
                                user_array.get(index).setBalance(user_array.get(index).getBalance() - transfer_amount);
                                user_array.get(to_index).setBalance(user_array.get(to_index).getBalance() + transfer_amount);
                                System.out.println("转账成功！");
                                break;
                            }
                            else {
                                System.out.println("余额不足！");
                            }
                        }
                        else {
                            System.out.println("输入有误，请重试！");
                        }
                    }
                }
                break;
            }
            else {
                System.out.println("你输入的卡号不存在，请检查后重试！");
            }
        }
    }

    private static void withdrawal(Scanner sc, ArrayList<Account> user_array, int index) {
        while (true) {
            System.out.println("==========欢迎使用ATM系统==========");
            System.out.println("请输入要取出的金额：");
            double balance = user_array.get(index).getBalance();
            double withdrawal_amount = sc.nextDouble();
            if (withdrawal_amount >= 0) {
                if (withdrawal_amount <= user_array.get(index).getBalance()) {
                    if (withdrawal_amount <= user_array.get(index).getLimit()) {
                        balance -= withdrawal_amount;
                        user_array.get(index).setBalance(balance);
                        System.out.println("取款成功！您的余额为：" + user_array.get(index).getBalance());
                        break;
                    }
                    else {
                        System.out.println("取款额超出单次取款额度，请重试！");
                    }
                }
                else {
                    System.out.println("余额不足！");
                }
            }
            else {
                System.out.println("输入有误，请检查后重试！");
            }
        }
    }

    private static void deposit(Scanner sc, ArrayList<Account> user_array, int index) {
        while (true) {
            System.out.println("==========欢迎使用ATM系统==========");
            System.out.println("请输入要存入的金额：");
            double balance = user_array.get(index).getBalance();
            double deposit_amount = sc.nextDouble();
            if (deposit_amount >= 0) {
                balance += deposit_amount;
                user_array.get(index).setBalance(balance);
                System.out.println("存款成功！您的余额为：" + user_array.get(index).getBalance());
                break;
            }
            else {
                System.out.println("输入有误，请重试！");
            }
        }
    }

    private static void query(Scanner sc, ArrayList<Account> user_array, int index) {
        System.out.println("==========用户信息查询如下==========");
        System.out.println("用户姓名：" + user_array.get(index).getUserName());
        System.out.println("用户卡号：" + user_array.get(index).getUserNumber());
        System.out.println("账户余额：" +user_array.get(index).getBalance());
        System.out.println("单次取款限额：" + user_array.get(index).getLimit());
    }

    //注册模块
    private static void signup(Scanner sc, Random ra, String userNumber, ArrayList<Account> user_array) {
        Account user = new Account();
        while (true) {
            System.out.println("==========欢迎使用ATM注册系统==========");
            System.out.println("请输入您的姓名:");
            String userName = sc.next();
            System.out.println("请输入单次取款限额:");
            int limit = sc.nextInt();
            System.out.println("请输入密码:");
            String password_1 = sc.next();
            System.out.println("请确认密码:");
            String password_2 = sc.next();

            //比较两次输入的密码是否一致
            if (password_1.equals(password_2)) {
                user.setUserName(userName);
                user.setLimit(limit);
                user.setUserPassword(password_1);
                user.setUserNumber(userNumber);
                user_array.add(user);
                int index = 0;
                for (int i = 0 ; i < user_array.size(); i++)
                    index = i;
                System.out.println("注册成功!");
                System.out.println("用户姓名：" + user_array.get(index).getUserName());
                System.out.println("用户卡号：" + user_array.get(index).getUserNumber());
                System.out.println("账户余额：" + user_array.get(index).getBalance());
                System.out.println("单次取款限额：" + user_array.get(index).getLimit());
                break;
            }
            else {
                System.out.println("两次密码不一致！请重试！");
            }
        }
    }

    //卡号生成模块
    private static String create_userNumber(ArrayList<String> userNumber_array) {
        String userNumber = "";
        Random ra = new Random();
        for (int i = 0; i < 10; i++) {
            userNumber += ra.nextInt(10);
        }
        while (userNumber_array.contains(userNumber)) {
            userNumber = "";
            for (int i = 0; i < 10; i++) {
                userNumber += ra.nextInt(10);
            }
        }
        userNumber_array.add(userNumber);
        return userNumber;
    }
}
```



## 运行效果

![image-20220707222107305](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220707222107305.png)







