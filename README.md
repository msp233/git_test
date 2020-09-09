# git_test
对于任何一个文件，在Git内都只有三种状态 :已提交(committed)，已修改(modified)和已暂存(staged)。

已提交表示该文件已经被 安全地保存在本地数据库中了; 已修改表示修改了某个文件，但 还没有提交保存;已暂存表示把 已修改的文件放在下次提交时要 保存的清单中。

```git
-- 拉取远程分支
git clone XXX

-- 创建并切换dev-1.1.1分支
git checkout -b dev-1.1.1

-- 提交分支(不修改文件)
git commit -m "创建dev-1.1.1分支"

-- 推送当前分支并建立与远程上游的跟踪
git push --set-upstream origin dev-1.1.1

-- 创建名为"feature-姓名全拼-日期"的分支进行开发
git checkout -b feature-maoshiping-20200906

-- 然后就可以开发了,修改文件后，添加，commit，push
git add XXX[对应要提交的文件]
git commit -m "XXX"
git push --set-upstream origin feature-maoshiping-20200906

-- 在feature分支开发完成后，需要合并到dev分支
git checkout dev-1.1.1
git merge feature-maoshiping-20200906
git push origin dev-1.1.1

-- 如果同时多个feature分支同时开发合到dev时，有可能会发生冲突
此时需要手动解决冲突，并重新add、commit、push

-- 经过一系列开发，dev1.1.1版本需要提测了，此时需要先创建一个fat-1.1.1分支，然后用fat-1.1。1那个分支打一个tag，叫fat，用测试用这个tag部署构建到对应的环境。
git checkout dev-1.1.1
git checkout -b fat-1.1.1
git tag fat

-- 提交fat-1.1.1 分支，提交fat tag
git push origin fat-1.1.1
git push origin fat

-- 当测试发现问题，直接在fat-1.1.1分支修改，然后浏览器删除fat的tag，重新生成一个tag，再次部署、测试，直至测试无问题。
git checkout fat-1.1.1
-- 一通修改后，联系管理员删除名为fat的tag
git tag fat
-- 提测 循环以上流程，直至测试无问题

-- 把fat-1.1.1分支的代码合并到dev-1.1.1并且合并到master，然后从master打一个online的tag
git checkout dev-1.1.1
git merge fat-1.1.1
git push dev-1.1.1

git checkout master
git merge fat-1.1.1
git push master


-- 若存在很多未推送的本地标签，想一次全部推送：
git push origin --tags


## add、merge前都要pull一下


-- 拉取远程tag到本地
git fetch origin tag fat

-- git 删除本地tag
git tag -d fat

-- 删除远程tag
git push origin :refs/tags/fat

--  强制提交   push 时增加 -f参数，强制提交，不建议用


```



# 什么是tag

tag是git版本库的一个标记，指向某个commit的指针。

tag主要用于发布版本的管理，一个版本发布之后，我们可以为git打上 v.1.0.1 v.1.0.2 ...这样的标签。

tag感觉跟branch有点相似，但是本质上和分工上是不同的：

tag 对应某次commit, 是一个点，是不可移动的。
branch 对应一系列commit，是很多点连成的一根线，有一个HEAD 指针，是可以依靠 HEAD 指针移动的。
所以，两者的区别决定了使用方式，改动代码用 branch ,不改动只查看用 tag。
tag 和 branch 的相互配合使用，有时候起到非常方便的效果，例如：已经发布了 v1.0 v2.0 v3.0 三个版本，这个时候，我突然想不改现有代码的前提下，在 v2.0 的基础上加个新功能，作为 v4.0 发布。就可以检出 v2.0 的代码作为一个 branch ，然后作为开发分支。



### 疑问：

1. git pull 命令。是只拉取当前分支的远程
2. 代码还是所有分支的远程代码