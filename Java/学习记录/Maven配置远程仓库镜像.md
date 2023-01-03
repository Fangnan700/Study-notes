# Maven配置远程仓库镜像

在项目的 pom.xml 文件中添加以下代码即可使用阿里云的镜像仓库：

```xml
<repositories>
        <repository>
            <id>sonatype-nexus-snapshots</id>
            <name>Sonatype Nexus Snapshots</name>
            <url>https://maven.aliyun.com/nexus/content/groups/public</url>
            <releases>
                <enabled>false</enabled>
            </releases>
            <snapshots>
                <enabled>true</enabled>
            </snapshots>
        </repository>
    </repositories>
```

