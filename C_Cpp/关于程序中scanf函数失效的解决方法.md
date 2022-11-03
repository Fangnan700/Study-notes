# 关于程序中scanf函数失效的解决方法

又是写bug的一天......

在写程序设计进阶课的结课项目时，遇到这样一个bug：

在使用scanf函数读取用户输入时，发现scanf函数被跳过了，无法从键盘输入数据，源代码如下：

```c
//学生信息添加模块
int information_adding_module()
{
    //函数声明
    int file_check();
    int file_create();

    //变量声明
    char whether_exsit;
    char whether_create;

    //添加学生信息菜单
    system("cls");
    printf("******************************************************************\n");
    printf("*                       学生信息维护系统                         *\n");
    printf("******************************************************************\n");
    printf("当前位置：添加学生信息\n");

    whether_exsit=file_check();
    if(whether_exsit==-1)
    {
        printf("信息文件不存在，是否新建信息文件？(y/n)");
        scanf("%c",&whether_create);
        if(whether_create=='y')
        {
            if(file_create()==1)
                printf("文件创建成功！");
            else
                printf("文件创建失败，请重试！");
        }
}
```

程序执行到 **printf("信息文件不存在，是否新建信息文件？(y/n)");** 处时，跳过了下一行的 **scanf** 函数。

查找bug原因，发现与scanf函数的读取方式有关。

用户从键盘输入数据时，数据被保存在缓冲区，包括空格、回车、tab等，输入结束按下回车后，程序再从缓冲区读取数据输入程序执行。在这段程序中，调用scanf函数之前缓冲区已经有数据存在（可能是之前输入的回车符之类的，来源不明）导致了程序直接读取了缓冲区内的数据，而不是等待用户输入。

解决方法：使用 **fflush()** 函数清空缓存区。

```c
fflush(stdin);
```

