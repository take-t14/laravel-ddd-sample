import React from "react";
import PropTypes from "prop-types";
import styled from "styled-components";

const Container = styled.div<{bgPhoto: string}>`
  position: relative;
  background-image: linear-gradient(rgba(0, 0, 0, 0.28), rgba(0, 0, 0, 0.7)),
    url(${(props:any) => props.bgPhoto});
  background-size: cover;
  border-radius: 8px;
  box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.08);
  display: flex;
  flex-direction: column;
  background-position: center center;
  align-items: center;
  justify-content: space-between;
  padding: 20px;
`;

const Content = styled.div`
  width: 100%;
  border-radius: 8px;
  position: relative;
  top: 50px;
  color: white;
  background-color: white;
  padding: 20px;
  box-shadow: 0 20px 20px 0 rgba(0, 0, 0, 0.07);
`;

const Title = styled.span`
  font-size: 24px;
  font-weight: 900;
  color: ${(props:any) => props.color};
`;

const Subtitle = styled.span`
  margin-top: 8px;
  font-size: 14px;
  display: block;
  color: ${(props:any) => props.color};
`;

const IconContainer = styled.div`
  cursor: pointer;
  color: ${(props:any) => props.color};
`;

const Top = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: row-reverse;
  width: 100%;
`;

const SecondTitle = styled.span`
  font-size: 20px;
  color: ${(props:any) => props.color};
  display: block;
  font-weight: 500;
`;

const BtnRow = styled.div`
  margin-top: 15px;
  display: flex;
  justify-content: space-between;
  width: 100%;
  align-items: center;
`;

const Btn = styled.span<{bgColor: string}>`
  color: ${(props:any) => props.color};
  background-color: ${(props:any) => props.bgColor};
  display: flex;
  align-items: center;
  justify-content: center;
  height: 32px;
  width: 32px;
  border-radius: 16px;
  cursor: pointer;
`;

const ReviewsContainer = styled.div`
  margin-bottom: 15px;
  font-size: 10px;
  color: #9ca1ae;
  & span:last-child {
    margin-left: 5px;
  }
`;

const StarContainer = styled.span`
  color: #f4d931;
`;

const FullStar = () => (
  <StarContainer>
    <i className="fas fa-star" />
  </StarContainer>
);

const HalfStar = () => (
  <StarContainer>
    <i className="fas fa-star-half" />
  </StarContainer>
);

interface Props {
  title:string,
  subtitle:string,
  titleColor:string,
  subtitleColor:string,
  iconName:string,
  iconSize:number,
  iconColor:string,
  bgPhoto:string,
  secondTitle:string,
  secondTitleColor:string,
  btnBg:string,
  btnColor:string,
  btnIcon:string,
  ratingAverage:number,
  totalReviews:number
}

const CardItem = ({
  title,
  subtitle,
  titleColor = "#1F2126",
  subtitleColor = "#9CA1AE",
  iconName,
  iconSize = 2,
  iconColor = "white",
  bgPhoto,
  secondTitle,
  secondTitleColor = "#1F2126",
  btnBg = "#006EFE",
  btnColor = "white",
  btnIcon,
  ratingAverage,
  totalReviews
}:Props) => (
  <Container bgPhoto={bgPhoto}>
    <Top>
      {iconName && (
        <IconContainer color={iconColor}>
          <i className={`${iconName} fa-${iconSize}x`} />
        </IconContainer>
      )}
    </Top>

    {(title || subtitle) && (
      <Content>
        <ReviewsContainer>
          {ratingAverage === 0.5 && <HalfStar />}
          {ratingAverage === 1 && <FullStar />}
          {ratingAverage === 1.5 && (
            <>
              <FullStar />
              <HalfStar />
            </>
          )}
          {ratingAverage === 2 && (
            <>
              <FullStar />
              <FullStar />
            </>
          )}
          {ratingAverage === 2.5 && (
            <>
              <FullStar />
              <FullStar />
              <HalfStar />
            </>
          )}
          {ratingAverage === 3 && (
            <>
              <FullStar />
              <FullStar />
              <FullStar />
            </>
          )}
          {ratingAverage === 3.5 && (
            <>
              <FullStar />
              <FullStar />
              <FullStar />
              <HalfStar />
            </>
          )}
          {ratingAverage === 4 && (
            <>
              <FullStar />
              <FullStar />
              <FullStar />
              <FullStar />
            </>
          )}
          {ratingAverage === 4.5 && (
            <>
              <FullStar />
              <FullStar />
              <FullStar />
              <FullStar />
              <HalfStar />
            </>
          )}
          {ratingAverage === 5 && (
            <>
              <FullStar />
              <FullStar />
              <FullStar />
              <FullStar />
              <FullStar />
            </>
          )}
          {totalReviews && (
            <span>
              {`${totalReviews === 1 ? "1 review" : `${totalReviews} reviews`}`}
            </span>
          )}
        </ReviewsContainer>
        {title && <Title color={titleColor}>{title}</Title>}
        {subtitle && <Subtitle color={subtitleColor}>{subtitle}</Subtitle>}
        {(secondTitle || btnIcon) && (
          <BtnRow>
            {secondTitle && (
              <SecondTitle color={secondTitleColor}>{secondTitle}</SecondTitle>
            )}
            {btnIcon && (
              <Btn color={btnColor} bgColor={btnBg}>
                <i className={btnIcon} />
              </Btn>
            )}
          </BtnRow>
        )}
      </Content>
    )}
  </Container>
);

CardItem.propTypes = {
  title: PropTypes.string,
  subtitle: PropTypes.string,
  iconName: PropTypes.string,
  iconSize: PropTypes.number,
  iconColor: PropTypes.string,
  bgPhoto: PropTypes.string,
  btnBg: PropTypes.string,
  btnColor: PropTypes.string,
  btnIcon: PropTypes.string,
  secondTitle: PropTypes.string,
  secondTitleColor: PropTypes.string,
  ratingAverage: PropTypes.oneOf([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
  totalReviews: PropTypes.number
};

export default CardItem;
