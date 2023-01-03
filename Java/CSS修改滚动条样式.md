# CSS修改滚动条样式

```css
/* 滚动槽 */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
::-webkit-scrollbar-track {
    border-radius: 5px;
    background: rgba(0,0,0,0.06);
    -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.08);
}
/* 滚动条滑块 */
::-webkit-scrollbar-thumb {
    border-radius: 5px;
    background: rgba(255,255,255,0.5);
    -webkit-box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
}
```