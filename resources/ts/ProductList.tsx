import React, { useState } from "react";
import { makeStyles } from '@material-ui/core/styles';
import { Grid, GridList, Typography } from "@material-ui/core";
import Card from "@material-ui/core/Card";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardContent from "@material-ui/core/CardContent";
import CardMedia from "@material-ui/core/CardMedia";
import Carousel from 'react-material-ui-carousel'
import blue from "../assets/img/blue.png";
import black from "../assets/img/black.png";
import green from "../assets/img/green.png";
import red from "../assets/img/red.png";
import orange from "../assets/img/orange.png";
import withWidth, { isWidthUp } from '@material-ui/core/withWidth';

const useStyles = makeStyles((theme) => ({
  aEnable: {
    textDecoration: 'none',
  },
  aDisable: {
    textDecoration: 'none',
    pointerEvents: "none",
  },
  colorIcon: {
    width: "100%"
    , padding: "0px"
  },
}));

type Props = {[key: string] : any}
 
const ProductList = (props:Props) => {
  const [loading, setLoading] = useState(false);
  const productList = JSON.parse(props.product_list)
  const classes = useStyles()
  function getColor(colorId:number) {
    switch(colorId) {
      case 1: return red
      case 2: return black
      case 3: return green
      case 4: return blue
      case 5: return orange
    }
  }
  const getGridListCols = () => {
    if (isWidthUp('xl', props.width)) {
      return 5;
    }
    if (isWidthUp('lg', props.width)) {
      return 4;
    }
    if (isWidthUp('md', props.width)) {
      return 3;
    }
    if (isWidthUp('sm', props.width)) {
      return 2;
    }
    return 1;
  }

  function getColorDataPrimary(colorId:number) {
    switch(colorId) {
      case 1: return "#f84848"
      case 2: return "#444"
      case 3: return "#29b864"
      case 4: return "#2175f5"
      case 5: return "#ff5521"
    }
  }
  const ColorContainer = (colors:any) => (
    <div className={"info" + " " + classes.colorIcon}>
    <div className="color-container">
      <div className="colors">
        {colors.map((color:any, index:number) => (
          <span className="color" key={index}
           data-primary={getColorDataPrimary(color.colorId.value)}
           onClick={(event) => console.log(color.colorName.value + "click")}
           color={color.colorName.value}></span>
        ))}
      </div>
    </div>
    </div>
  );
  function aClick(productGroup:any) {
    if (loading) {
      return
    }
    setLoading(true)
    window.location.href = ("" != props.url_prefix ? "/" : "") + props.url_prefix + "/product/detail/" + productGroup.productGroupId.value
  }
  return (
    <div style={{ margin: "5%", padding: "5%" }}>
      <Grid container spacing={10} justify="center">
        <GridList cols={getGridListCols()} spacing={30} cellHeight={'auto'}>
          {productList.map((productGroup:any, index:number) => (
            <Grid item key={index}>
              <Card>
                <a 
                 className={loading ? classes.aDisable : classes.aEnable}
                 onClick={() => aClick(productGroup)}>
                  <Carousel autoPlay={true} indicators={false} navButtonsAlwaysInvisible={true}>
                    {productGroup.colors.map((color:any, index:number) => (
                      <CardActionArea key={index}>
                        <CardMedia
                          component="img"
                          alt="Contemplative Reptile"
                          height="100%"
                          title="Contemplative Reptile"
                          src={getColor(color.colorId.value)}
                        />
                        <CardContent>
                          <Typography gutterBottom variant="h5" component="h2">
                            {productGroup.productGroupName.value}
                          </Typography>
                          <Typography component="p">¥{productGroup.lowPriceTaxIn.value.toLocaleString()}〜¥{productGroup.heightPriceTaxIn.value.toLocaleString()}（税込）</Typography>
                        </CardContent>
                      </CardActionArea>
                    ))}
                  </Carousel>
                </a>
                {ColorContainer(productGroup.colors)}
              </Card>
            </Grid>
          ))}
        </GridList>
      </Grid>
    </div>
  )
}

export default withWidth()(ProductList);