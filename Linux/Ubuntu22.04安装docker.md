# Ubuntu22.04安装docker

## 0.卸载旧版本

```shell
sudo apt-get remove docker
sudo apt-get remove docker-engine
sudo apt-get remove docker.io
```

## 1.添加使用 HTTPS 传输的软件包以及 CA 证书

```shell
sudo apt-get update
sudo apt-get install \
     apt-transport-https \
     ca-certificates \
     curl \
     gnupg \
     lsb-release
```

## 2.添加软件源的GPG密钥

```shell
curl -fsSL https://mirrors.aliyun.com/docker-ce/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
```

## 3.向 sources.list 中添加 Docker 软件源

```shell
echo \
  "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://mirrors.aliyun.com/docker-ce/linux/ubuntu \
  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```

## 4.安装docker

```shell
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io
```

## 5.启动docker

```shell
sudo systemctl enable docker
sudo systemctl start docker
```

