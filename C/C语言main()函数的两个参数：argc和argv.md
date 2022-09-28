# C语言main()函数的两个参数：argc和argv

又是一个改bug改出来的陌生知识点.......

在写二叉树算法的demo时，明明所有逻辑都是正确的，编译也没有任何报错，但是在运行的时候总是报错：Segmentation fault(core dumped) 【段错误（核心已转储）】

查了资料，也只知道这可能是由于指针非法访问内存导致的，但始终无法找到问题的根源。

终于，对着别人的代码一段一段改，才找到了问题的根源......

报错的代码如下：

```c
#include<stdio.h>
#include<stdlib.h>

typedef struct treeNode{
    char data;
    struct treeNode *lchild;
    struct treeNode *rchild;
}treeNode;

void create(treeNode **T, char *data, int *index){
    char ch;
    ch = data[*index];
    *index += 1;
    if(ch == '#'){
        (*T) = NULL;
    }
    else{
        (*T) = (treeNode *)malloc(sizeof(treeNode));
        (*T)->data = ch;
        create(&((*T)->lchild), data, index); 
        create(&((*T)->rchild), data, index);
    }
}

void preOder(treeNode *T){
    if(T == NULL){
        return;
    }
    else{
        printf("%c ", T->data);
        preOder(T->lchild);
        preOder(T->rchild);
    }
}

int main(char *argv[]){
    treeNode *T;
    int index = 0;
    create(&T, argv[1], &index);
    preOder(T);
    printf("\n");
    return 0;
}
```

修改之后的代码如下：

```c
#include<stdio.h>
#include<stdlib.h>

typedef struct treeNode{
    char data;
    struct treeNode *lchild;
    struct treeNode *rchild;
}treeNode;

void create(treeNode **T, char *data, int *index){
    char ch;
    ch = data[*index];
    *index += 1;
    if(ch == '#'){
        (*T) = NULL;
    }
    else{
        (*T) = (treeNode *)malloc(sizeof(treeNode));
        (*T)->data = ch;
        create(&((*T)->lchild), data, index); 
        create(&((*T)->rchild), data, index);
    }
}

void preOder(treeNode *T){
    if(T == NULL){
        return;
    }
    else{
        printf("%c ", T->data);
        preOder(T->lchild);
        preOder(T->rchild);
    }
}

int main(int argc, char *argv[]){
    treeNode *T;
    int index = 0;
    create(&T, argv[1], &index);
    preOder(T);
    printf("\n");
    return 0;
}
```

修改的地方是补全了main()函数的参数，即argc和argv[]。



**补充知识：**

main函数的标准形式：

```c
main(int argc,char *argv[])
```

其参数argc和argv用于运行时,把命令行参数传入主程序。

**1、argc：arguments count(参数计数)**

运行程序传送给main函数的命令行参数总个数，包括可执行程序名。

其中当argc=1时表示只有一个程序名称，参数存储在argv[0]中。

**2、argv[]：字符串数组,用来存放指向字符串参数的指针数组**

argv[]中每个元素指向一个参数，用空格分隔参数。

argv数组长度为argc，

其存储规则如下：

| 索引       | 内容                                              |
| ---------- | ------------------------------------------------- |
| argv[0]    | 指向程序运行时的全路径名                          |
| argv[1]    | 指向程序在终端中执行程序名后的第一个字符串(参数1) |
| argv[2]    | 指向程序在终端中执行程序名后的第二个字符串(参数2) |
| ......     | ......                                            |
| argv[argc] | NULL                                              |

补充知识之后就能理解原来的那段代码为什么在执行时会报错非法访问内存了。

由于原来的代码没有设置argc，所以传入的argv[]的长度是随机值，导致了在程序递归调用参数的时候，会访问到非法的内存区域，导致报错。

至此，终于解决了这个bug........